<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;

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

        Route::get('/books', 'books')->name('books');
        Route::get('/books/{slug}', 'book')->name('book');

        Route::get('/devotionals', 'devotionals')->name('devotionals');
        Route::get('/devotionals/{slug}', 'devotional')->name('devotional');

        Route::get('/videos', 'videos')->name('videos');

        Route::get('/articles', 'articles')->name('articles');
        Route::get('/articles/{slug}', 'article')->name('article');

        Route::get('/photos', 'photos')->name('photos');
        Route::get('/photos/{slug}', 'photo')->name('photo');

        Route::get('/page_headers', 'page_headers')->name('page_headers');

        Route::get('/about-us', 'about_us')->name('about_us');
        
        Route::post('/logout', 'logout');
    });
});

Route::controller(PageController::class)->group(function(){
    Route::get('/', 'index')->name('home');
});
