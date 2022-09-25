<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MinisterController;
use App\Http\Controllers\DevotionalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('users/{id}', [AuthController::class, 'show']);
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);
    Route::put('users/{id}', [AuthController::class, 'update']);
    
    Route::post('/series', [SeriesController::class, 'store'])->name('createSeries');
    Route::post('/series/{id}', [SeriesController::class, 'update'])->name('updateSeries');
    Route::delete('/series/{id}', [SeriesController::class, 'destroy'])->name('deleteSeries');

    Route::get('/ministers', [MinisterController::class, 'index'])->name('ministers');
    Route::post('/ministers', [MinisterController::class, 'store'])->name('createMinister');
    Route::get('ministers/{id}', [MinisterController::class, 'show'])->name('getMinisterById');
    Route::post('/ministers/{id}', [MinisterController::class, 'update'])->name('updateMinister');
    Route::delete('/ministers/{id}', [MinisterController::class, 'destroy'])->name('deleteMinister');

    Route::post('/messages', [MessageController::class, 'store'])->name('createMessage');
    Route::post('/messages/{id}', [MessageController::class, 'update'])->name('updateMessage');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('deleteMessage');

    Route::post('/books', [BookController::class, 'store'])->name('createBook');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('getBookById');
    Route::post('books/{id}', [BookController::class, 'update'])->name('updateBook');
    Route::delete('books/{id}', [BookController::class, 'destroy'])->name('deleteBook');

    Route::post('/videos', [VideoController::class, 'store'])->name('createVideo');
    Route::get('/videos/{id}', [VideoController::class, 'show'])->name('getVideoById');
    Route::post('/videos/{id}', [VideoController::class, 'update'])->name('updateVideo');
    Route::delete('/videos/{id}', [VideoController::class, 'destroy'])->name('deleteVideo');

    Route::post('/photos', [PhotoController::class, 'store'])->name('createPhoto');
    Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('getPhotoById');
    Route::post('/photos/{id}', [PhotoController::class, 'update'])->name('updatePhoto');
    Route::delete('/photos/{id}', [PhotoController::class, 'desroy'])->name('deletePhoto');

    Route::post('/devotionals', [DevotionalController::class, 'store'])->name('createDevotional');
    Route::get('/devotionals/{id}', [DevotionalController::class, 'show'])->name('getDevotionalById');
    Route::post('/devotionals/{id}', [DevotionalController::class, 'update'])->name('updateDevotional');
    Route::delete('/devotionals/{id}', [DevotionalController::class, 'destroy'])->name('deleteDevotional');

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/series', [SeriesController::class, 'index'])->name('series');
Route::get('/series/{slug}', [SeriesController::class, 'show'])->name('getSeriesBySlug');


Route::get('/ministers/internal', [MinisterController::class, 'internalMinisters'])->name('internaalMinisters');
Route::get('ministers/by-slug/{slug}', [MinisterController::class, 'bySlug'])->name('getMinisterBySlug');

Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('getMessageById');
Route::get('/messages/by-slug/{slug}', [MessageController::class, 'bySlug'])->name('getMessageBySlug');

Route::get('/books', [BookController::class, 'index'])->name('books');
Route::get('/books/by-slug/{slug}', [BookController::class, 'bySlug'])->name('getBookBySlug');

Route::get('/videos', [VideoController::class, 'index'])->name('videos');
Route::get('/videos/by-slug/{slug}', [VideoController::class, 'bySlug'])->name('getVideoBySlug');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
Route::get('/photos/by-slug/{slug}', [PhotoController::class, 'bySlug'])->name('getPhotoBySlug');

Route::get('/devotionals', [DevotionalController::class, 'index'])->name('allDevotionals');
Route::get('/devotionals/by-date/today', [DevotionalController::class, 'todayDevotional'])->name('todayDevotional');
Route::get('/devotionals/by-date/previous', [DevotionalController::class, 'previousDevotionals'])->name('previousDevotionals');
Route::get('/devotionals/by-slug/{slug}', [DevotionalController::class, 'bySlug'])->name('getDevotionalBySlug');