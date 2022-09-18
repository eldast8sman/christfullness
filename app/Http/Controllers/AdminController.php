<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Series;
use App\Models\Message;
use App\Models\Minister;
use App\Models\Devotional;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function admins(){
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.admins', [
            'users' => $users
        ]);
    }

    public function show_admin($id){
        $user = User::where('id', $id)->first();
        return view('admin.edit_admin', [
            'user' => $user
        ]);
    }

    public function ministers(){
        $ministers = Minister::orderBy('appearance', 'asc')->orderBy('updated_at', 'desc')->get();
        foreach($ministers as $minister){
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
        }
        $count = $ministers->count();
        return view('admin.ministers', [
            'ministers' => $ministers,
            'count' => $count
        ]);
    }

    public function showMinister($slug){
        $minister = Minister::where('slug', $slug)->first();
        $minister->filepath = url($minister->filepath);
        $minister->compressed = url($minister->compressed);
        $count = Minister::get()->count();
        return view('admin.minister', [
            'minister' => $minister,
            'count' => $count
        ]);
    }

    public function series(){
        $series = Series::orderBy('start_date', 'desc')->get();
        foreach($series as $ser){
            $ser->filepath = url($ser->filepath);
            $ser->compressed = url($ser->compressed);
        }
        return view('admin.series', [
            'series' => $series
        ]);
    }

    public function showSeries($slug){
        $series = Series::where('slug', $slug)->first();
        $series->filepath = url($series->filepath);
        $series->compressed = url($series->compressed);
        $ministers = Minister::orderBy('name', 'asc')->get();
        $messages = $series->messages()->orderBy('date_preached', 'desc')->get();
        foreach($messages as $message){
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->audio_path = url($message->audio_path);
        }
        return view('admin.single_series', [
            'series' => $series,
            'ministers' => $ministers,
            'messages' => $messages
        ]);
    }

    public function messages(){
        $messages = Message::orderBy('date_preached', 'desc')->paginate(20);
        foreach($messages as $message){
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->audio_path = url($message->audio_path);
        }
        $ministers = Minister::orderBy('name', 'asc')->get();
        $series = Series::orderBy('start_date', 'desc')->get();

        return view('admin.messages', [
            'messages' => $messages,
            'series' => $series,
            'ministers' => $ministers
        ]);
    }

    public function showMessage($slug){
        $message = Message::where('slug', $slug)->first();
        if(!empty($message->series_id)){
            $series = $message->series()->first();
            $series->filepath = url($series->filepath);
            $series->compressed = url($series->compressed);            
            $message->series = $series;
        }
        $minister = $message->minister()->first();
        $minister->filepath = url($minister->filepath);
        $minister->compressed = url($minister->compressed);
        $message->image_path = url($message->image_path);
        $message->audio_path = url($message->audio_path);
        $message->compressed_image = url($message->compressed_image);
        $message->minister = $minister;

        $ministers = Minister::orderBy('name', 'asc')->get();
        $series = Series::orderBy('start_date', 'desc')->get();

        return view('admin.message', [
            'message' => $message,
            'series' => $series,
            'ministers' => $ministers
        ]);
    }

    public function devotionals(){
        $today_dev = Devotional::where('deveotional_date', date('Y-m-d'))->first();
    }

    public function books(){
        $books = Book::orderBy('created_at', 'desc')->paginate(2);
        foreach($books as $book){
            $book->book_path = url($book->book_path);
            $book->image_path = url($book->image_path);
            $book->compressed_image = url($book->compressed_image);
            $book->author = $book->author();
        }
        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.books', [
            'books' => $books,
            'ministers' => $ministers
        ]);
    }

    public function book($slug){
        $book = Book::where('slug', $slug)->first();
        $book->book_path = url($book->book_path);
        $book->image_path = url($book->image_path);
        $book->compressed_image = url($book->compressed_image);
        $book->author = $book->author();
        $book->author->filepath = url($book->author->filepath);
        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.book', [
            'book' => $book,
            'ministers' => $ministers
        ]);
    }
}
