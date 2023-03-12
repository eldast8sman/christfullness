<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\MinisterController;
use App\Http\Controllers\DevotionalController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\PageHeaderController;
use App\Http\Controllers\WelcomeMessageController;

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
    
    Route::controller(AuthController::class)->group(function(){
        Route::get('users/{id}', 'show');
        Route::delete('/users/{id}', 'destroy');
        Route::put('users/{id}', 'update');
        Route::post('/logout', 'logout');
    });
    
    Route::controller(SeriesController::class)->group(function(){
        Route::post('/series', 'store')->name('createSeries');
        Route::post('/series/{id}', 'update')->name('updateSeries');
        Route::delete('/series/{id}', 'destroy')->name('deleteSeries');
    });

    Route::controller(MinisterController::class)->group(function(){
        Route::get('/ministers', 'index')->name('ministers');
        Route::post('/ministers', 'store')->name('createMinister');
        Route::get('ministers/{id}', 'show')->name('getMinisterById');
        Route::post('/ministers/{id}', 'update')->name('updateMinister');
        Route::delete('/ministers/{id}', 'destroy')->name('deleteMinister');
    });

    Route::controller(MessageController::class)->group(function(){
        Route::post('/messages', 'store')->name('createMessage');
        Route::post('/messages/{id}', 'update')->name('updateMessage');
        Route::delete('/messages/{id}', 'destroy')->name('deleteMessage');
    });

    Route::controller(BookController::class)->group(function(){
        Route::post('/books', 'store')->name('createBook');
        Route::get('/books/{id}', 'show')->name('getBookById');
        Route::post('books/{id}', 'update')->name('updateBook');
        Route::delete('books/{id}', 'destroy')->name('deleteBook');
    });

    Route::controller(VideoController::class)->group(function(){
        Route::post('/videos', 'store')->name('createVideo');
        Route::get('/videos/{id}', 'show')->name('getVideoById');
        Route::post('/videos/{id}', 'update')->name('updateVideo');
        Route::delete('/videos/{id}', 'destroy')->name('deleteVideo');
    });
    
    Route::controller(PhotoController::class)->group(function(){
        Route::post('/photos', 'store')->name('createPhoto');
        Route::get('/photos/{id}', 'show')->name('getPhotoById');
        Route::post('/photos/{id}', 'update')->name('updatePhoto');
        Route::delete('/photos/{id}', 'destroy')->name('deletePhoto');
    });

    Route::controller(DevotionalController::class)->group(function(){
        Route::post('/devotionals', 'store')->name('createDevotional');
        Route::get('/devotionals/{id}', 'show')->name('getDevotionalById');
        Route::post('/devotionals/{id}', 'update')->name('updateDevotional');
        Route::delete('/devotionals/{id}', 'destroy')->name('deleteDevotional');
    });

    Route::controller(ArticleController::class)->group(function(){
        Route::post('/articles', 'store')->name('createArticle');
        Route::get('/articles/{id}', 'show')->name('getArticleById');
        Route::post('/articles/{id}', 'update')->name('updateArticle');
        Route::delete('/articles/{id}', 'destroy')->name('deleteArticle');
    });

    Route::controller(PageHeaderController::class)->group(function(){
        Route::post('/page_headers', 'store')->name('createPageHeader');
        Route::post('/page_headers/{id}', 'update')->name('updatePageHeader');
        Route::delete('/page_headers/{id}', 'destroy')->name('deletePageHeader');
    });

    Route::controller(HomeSliderController::class)->group(function(){
        Route::post('/home_sliders', 'store')->name('createHomeSlider');
        Route::get('/home_sliders/{id}', 'show')->name('homeSlider');
        Route::post('/home_sliders/{id}', 'update')->name('updateHomeSlider');
        Route::delete('/home_sliders/{id}', 'destroy')->name('deleteHomeSlider');
    });

    Route::controller(WelcomeMessageController::class)->group(function(){
        Route::post('/welcoming', 'adding_message');
    });

    Route::controller(HomeBannerController::class)->group(function(){
        Route::post('/home-banner', 'update_banner');
    });

    Route::controller(QuoteController::class)->group(function(){
        Route::get('/quotes', 'index');
        Route::post('/quotes', 'store');
        Route::get('/quotes/{id}', 'show');
        Route::post('/quotes/{id}', 'update');
        Route::delete('/quotes/{id}', 'destroy');
    });

    Route::controller(AboutController::class)->group(function(){
        Route::get('/about-us', 'index');
        Route::post('/about-us', 'store');
        Route::get('/about-us/{id}', 'show');
        Route::post('/about-us/{id}', 'update');
        Route::delete('/about-us/{id}', 'destroy');
        Route::delete('/about-us/photos/{id}', 'destroy_photo');
    });

    Route::controller(MagazineController::class)->group(function(){
        Route::get('/magazines', 'index');
        Route::post('/magazines', 'store');
        Route::get('/magazines/{id}', 'show');
        Route::get('/magazines/by-slug/{slug}', 'bySlug');
        Route::post('/magazines/{id}', 'update');
        Route::delete('/magazines/{id}', 'destroy');
    });
    
    Route::controller(EventController::class)->group(function(){
        Route::get('/events', 'index');
        Route::post('/events', 'store');
        Route::get('/events/{id}', 'show');
        Route::get('/events/by-slug/{slug}', 'bySlug');
        Route::post('/events/{id}', 'update');
        Route::delete('/events/{id}', 'destroy');
    });
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

Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'bySlug'])->name('getArticleBySlug');

Route::get('/page_headers', [PageController::class, 'index'])->name('pageHeaders');
Route::get('/page_headers/{id}', [PageHeaderController::class, 'show'])->name('pageHeader');

Route::get('/home_sliders', [HomeSliderController::class, 'index'])->name('homeSliders');

Route::post('/send-message', [AboutController::class, 'contact_us']);
