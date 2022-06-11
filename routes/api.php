<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MinisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/series', [SeriesController::class, 'index'])->name('series');
Route::post('/series', [SeriesController::class, 'store'])->name('createSeries');
Route::get('/series/{slug}', [SeriesController::class, 'show'])->name('getSeriesBySlug');
Route::post('/series/{id}', [SeriesController::class, 'update'])->name('updateSeries');
Route::delete('/series/{id}', [SeriesController::class, 'delete'])->name('deleteSeries');
Route::get('/ministers', [MinisterController::class, 'index'])->name('ministers');
Route::get('/ministers/internal', [MinisterController::class, 'internalMinisters'])->name('internaalMinisters');
Route::post('/ministers', [MinisterController::class, 'store'])->name('createMinister');
Route::get('ministers/{id}', [MinisterController::class, 'show'])->name('getMinisterById');
Route::get('ministers/by-slug/{slug}', MinisterController::class, 'bySlug')->name('getMinisterBySlug');
Route::post('/ministers/{id}', [MinisterController::class, 'update'])->name('updateMinister');
Route::delete('/ministers/{id}', [MinisterController::class, 'destroy'])->name('deleteMinister');
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::post('/messages', [MessageController::class, 'store'])->name('createMessage');
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('getMessageById');
Route::get('/messages/by-slug/{slug}', [MessageController::class, 'bySlug'])->name('getMessageBySlug');
Route::post('/messages/{id}', [MessageController::class, 'update'])->name('updateMessage');
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('deleteMessage');
