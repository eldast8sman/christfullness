<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc');
        if($books->count() > 0){
            foreach($books->get() as $book){
                $book->image_path = url($book->image_path);
                $book->compressed_image = url($book->compressed_image);
                $book->book_path = url($book->book_path);
            }
            return response([
                'status' => 'success',
                'message' => 'Books found',
                'data' => $books->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Book was found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $all = $request->all();
        $image = $all['image_path'];
        unset($all['image_path']);
        $upload_image = FileController::uploadfile($image, 'books');
        if($upload_image){
            $all['image_path'] = 'img/books/'.$upload_image;
            $all['compressed_image'] = 'img/books/compressed/'.$upload_image;
        }
        $document = $all['book_path'];
        unset($all['book_path']);
        $upload_book = FileController::uploadfile($document, 'books');
        if($upload_book){
            $all['book_path'] = 'document/books/'.$upload_book;
        }
        $book = Book::create($all);
        if($book){
            $book->image_path = url($book->image_path);
            $book->compressed_image = url($book->compressed_image);
            $book->book_path = url($book->book_path);
            return response([
                'status' => 'success',
                'message' => 'Book uploaded successfully',
                'data' => $book
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Book uploading failed'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, $id)
    {
        $book = Book::where('id', $id)->first();
        if(!empty($book)){
            $minister = $book->author()->get();
            if(!empty($minister)){
                $minister->filepath = url($minister->filepath);
                $minister->compressed = url($minister->compressed);
            }
            $book->author = $minister;
            return response([
                'status' => 'success',
                'message' => 'Book found',
                'data' => $book
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Book not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Display the specified resource by slug
     */
    public function bySlug(Book $book, $slug)
    {
        $book = Book::where('slug', $slug)->first();
        if(!empty($book)){
            $minister = $book->author()->get();
            if(!empty($minister)){
                $minister->filepath = url($minister->filepath);
                $minister->compressed = url($minister->compressed);
            }
            $book->author = $minister;
            return response([
                'status' => 'success',
                'message' => 'Book found',
                'data' => $book
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Book not found',
                'data' => []
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        if($book){
            $all = $request->all();
            if(!empty($all['image_path'])){
                $image = $all['image_path'];
                unset($all['image_path']);
                if($image instanceof UploadedFile){
                    FileController::delete_file($book->image_path);
                    FileController::delete_file($book->compressed_image);

                    $upload = FileController::uploadfile($image, 'books');
                    if($upload){
                        $all['image_path'] = 'img/books/'.$upload;
                        $all['compressed_image'] = 'img/compressed/'.$upload;
                    }
                }
            } else {
                unset($all['image_path']);
            }
            if(!empty($all['book_path'])){
                $document = $all['book_path'];
                unset($all['book_path']);
                if($document instanceof UploadedFile){
                    FileController::delete_file($book->book_path);

                    $upload = FileController::uploadfile($document, 'books');
                    if($upload){
                        $all['book_path'] = 'document/books/'.$upload;
                    }
                }
            } else {
                unset($all['book_path']);
            }
            if($book->update($all)){
                $book->image_path = url($book->image_path);
                $book->compressed_image = url($book->compressed_image);
                $book->book_path = url($book->book_path);
                return response([
                    'status' => 'success',
                    'message' => 'Book Updated successfully',
                    'data' => $book
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in updating Book'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Book not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $id)
    {
        $book = Book::find($id);
        if($book){
            FileController::delete_file($book->image_path);
            FileController::delete_file($book->compressed_image);
            FileController::delete_file($book->pdf_path);
            $book->delete();
            return response([
                'status' => 'success',
                'message' => 'Book Deleted successfully',
                'data' => $book
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Book failed to delete successfully',
            ], 404);
        }
    }
}
