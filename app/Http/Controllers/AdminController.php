<?php

namespace App\Http\Controllers;

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
        return view('admin.admins');
    }
}
