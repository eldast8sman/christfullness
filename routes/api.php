<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
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
Route::post('/ministers', [MinisterController::class, 'store'])->name('createMinister');
Route::get('minister/{id}', [MinisterController::class, 'show'])->name('getMinisterById');
Route::get('minister/by-slug/{slug}', MinisterController::class, 'bySlug')->name('getMinisterBySlug');
Route::post('/minister/{id}', [MinisterController::class, 'update'])->name('updateMinister');
Route::delete('/minister/{id}', MinisterController::class, 'destroy')->name('deleteMinister');
