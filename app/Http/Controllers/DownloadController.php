<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function download_book($slug){
        $book = Book::where('slug', $slug)->first();
        if(!empty($book)){
            if(file_exists($book->book_path)){
                $filename = $book->slug.".pdf";
                $book->downloads += 1;
                $book->save();
                
                return Response::download($book->book_path, $filename, ['Content-Type: application/pdf']);
            } else {
                echo "Book File does not exist";
            }
        } else {
            die("Book not found");
        }
    }
}
