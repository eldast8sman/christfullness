<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
