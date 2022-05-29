<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::put('/series/{id}', [SeriesController::class, 'update'])->name('updateSeries');
Route::delete('/series/{id}', [SeriesController::class, 'delete'])->name('deleteSeries');
