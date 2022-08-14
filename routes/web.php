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
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/login', [AdminController::class, 'login']);

    Route::get('/admins', [AdminController::class, 'admins']);
    Route::get('/admin/{id}', [AdminController::class, 'show_admin']);

    Route::get('/ministers', [AdminController::class, 'ministers'])->name('Ministers');
    Route::get('/ministers/{slug}', [AdminController::class, 'showMinister'])->name('minister');

    Route::get('/message-series', [AdminController::class, 'series'])->name('series');

    Route::post('/logout', [AuthController::class, 'logout']);
});
