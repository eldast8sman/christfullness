<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Series;
use App\Models\Message;
use App\Models\Minister;
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
        return view('admin.single_series', [
            'series' => $series
        ]);
    }

    public function messages(){
        $messages = Message::orderBy('date_preached', 'desc')->paginate(2);
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
}
