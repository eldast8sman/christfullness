<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Magazine;
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
                die("Book File does not exist");
            }
        } else {
            die("Book not found");
        }
    }

    public function download_magazine($slug){
        $magazine = Magazine::where('slug', $slug)->first();
        if(!empty($magazine)){
            if(file_exists($magazine->document_path)){
                $filename = $magazine->slug.".pdf";
                $magazine->downloads += 1;
                $magazine->save();

                return Response::download($magazine->document_path, $filename, ['Content-Type: application/pdf']);
            } else {
                die("Document File does not exist");
            }
        } else {
            die("Magazine not found");
        }
    }
}
