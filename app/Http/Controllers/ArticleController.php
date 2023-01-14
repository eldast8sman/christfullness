<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\UploadedFile;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created', 'desc');
        if($articles->count() > 0){
            $articles = $articles->get();
            foreach($articles as $article){
                $article->image_path = url($article->image_path);
                $article->compressed_image = url($article->compressed_image);
            }
            return response([
                'status' => 'success',
                'message' => 'Articles found',
                'data' => $articles
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was found'
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
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $all = $request->all();
        $image_path = $all['image_path'];
        unset($all['image_path']);
        $upload_image = FileController::uploadfile($image_path, 'articles');
        if($upload_image){
            $all['image_path'] = 'img/articles/'.$upload_image;
            $all['compressed_image'] = 'img/articles/compressed/'.$upload_image;
        }
        $all['all_details'] = $all['title'].' '.$all['article'].' '.$all['author'].' '.date('l, jS F, Y', strtotime($all['published']));
        $article = Article::create($all);
        if($article){
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
            return response([
                'status' => 'success',
                'message' => 'Book uploaded successfully',
                'data' => $article
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Article uploading failed'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if($article){
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
            return response([
                'status' => 'success',
                'message' => 'Article fetched successfully',
                'data' => $article
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Article was not fetched'
            ], 404);
        }
    }

    /**
     * Display the specified resource by Slug
     */
    public function bySlug($slug){
        $article = Article::where('slug', $slug);
        if($article->count() > 0){
            $article = $article->first();
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
            return response([
                'status' => 'success',
                'message' => 'Article fetched successfully',
                'data' => $article
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::find($id);
        if(!empty($article)){
            $all = $request->all();
            if(!empty($all['image_path'])){
                $image_path = $all['image_path'];
                unset($all['image_path']);
                if($image_path instanceof UploadedFile){
                    FileController::delete_file($article->image_path);
                    FileController::delete_file($article->compressed_image);

                    $upload = FileController::uploadfile($image_path, 'articles');
                    if($upload){
                        $all['image_path'] = 'img/articles/'.$upload;
                        $all['compressed_image'] = 'img/articles/compressed/'.$upload;
                    }
                }
            } else {
                unset($all['image_path']);
            }
            $all['all_details'] = $all['title'].' '.$all['article'].' '.$all['author'].' '.date('l, jS F, Y', strtotime($all['published']));
            if($article->update($all)){
                $article->image_path = url($article->image_path);
                $article->compressed_image = url($article->compressed_image);
                return response([
                    'status' => 'success',
                    'message' => 'Book Updated successfully',
                    'data' => $article
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Error in updating Article'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if(!empty($article)){
            FileController::delete_file($article->image_path);
            FileController::delete_file($article->compressed_image);
            $article->delete();
            return response([
                'status' => 'success',
                'message' => 'Article Deleted Successfully',
                'data' => $article
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was found'
            ], 404);
        }
    }
}
