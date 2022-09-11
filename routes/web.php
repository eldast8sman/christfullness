<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('dashboard')->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'index');
        Route::get('/login', 'login');

        Route::get('/admins', 'admins');
        Route::get('/admin/{id}', 'show_admin');

        Route::get('/ministers', 'ministers')->name('Ministers');
        Route::get('/ministers/{slug}', 'showMinister')->name('minister');

        Route::get('/message-series', 'series')->name('series');
        Route::get('/message-series/{slug}', 'showSeries')->name('showseries');

        Route::get('/messages', 'messages')->name('messages');
        Route::get('/messages/{slug}', 'showMessage')->name('message');

        Route::get('/devotionals', 'devotionals')->name('devotionals');
        
        Route::post('/logout', 'logout');
    });
});
