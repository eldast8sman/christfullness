<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Book;
use App\Models\User;
use App\Models\About;
use App\Models\Event;
use App\Models\Photo;
use App\Models\Quote;
use App\Models\Video;
use App\Models\Series;
use App\Models\Article;
use App\Models\Message;
use App\Models\Magazine;
use App\Models\Minister;
use App\Models\Devotional;
use App\Models\HomeBanner;
use App\Models\HomeSlider;
use App\Models\PageHeader;
use Illuminate\Http\Request;
use App\Models\WelcomeMessage;

class AdminController extends Controller
{
    public function index(){
        $sliders = HomeSlider::orderBy('position', 'asc')->orderBy('updated_at', 'desc')->get();
        foreach($sliders as $slider){
            $slider->filename = url($slider->filename);
            $slider->compressed = url($slider->compressed);
        }
        if(!empty($welcome = WelcomeMessage::first())){
            $welcome->filename = url($welcome->filename);
            $welcome->compressed = url($welcome->compressed);
        } else {
            $welcome = new stdClass();
            $welcome->filename = "";
            $welcome->compressed = "";
            $welcome->heading = "";
            $welcome->content = "";
        }
        $banner = HomeBanner::first();
        if(empty($banner)){
            $banner = new stdClass();
            $banner->title = "";
            $banner->content = "";
            $banner->link = "";
            $banner->call_to_action = "";
        }
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        foreach($quotes as $quote){
            $quote->filename = url($quote->filename);
            $quote->compressed = url($quote->compressed);
        }
        
        return view('admin.index', [
            'sliders' => $sliders,
            'slider_count' => HomeSlider::count(),
            'welcome' => $welcome,
            'banner' => $banner,
            'quotes' => $quotes
        ]);
    }

    public function login(){
        return view('admin.login');
    }

    public function about_us(){
        $abouts = About::orderBy('position', 'asc')->orderBy('updated_at', 'desc')->get();
        foreach($abouts as $about){
            if(!empty($about->filename)){
                $about->filename = url($about->filename);
                $about->compressed = url($about->compressed);
            }
        }

        return view('admin.about_us', [
            'abouts' => $abouts,
            'about_count' => About::count()
        ]);
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

    public function ministers(){
        $ministers = Minister::orderBy('appearance', 'asc')->orderBy('updated_at', 'desc')->get();
        foreach($ministers as $minister){
            $minister->filepath = url($minister->filepath);
            $minister->compressed = url($minister->compressed);
        }
        $count = $ministers->count();
        return view('admin.ministers', [
            'ministers' => $ministers,
            'count' => $count
        ]);
    }

    public function showMinister($slug){
        $minister = Minister::where('slug', $slug)->first();
        $minister->filepath = url($minister->filepath);
        $minister->compressed = url($minister->compressed);
        $count = Minister::get()->count();
        return view('admin.minister', [
            'minister' => $minister,
            'count' => $count
        ]);
    }

    public function series(){
        $series = Series::orderBy('start_date', 'desc')->get();
        foreach($series as $ser){
            $ser->filepath = url($ser->filepath);
            $ser->compressed = url($ser->compressed);
        }
        return view('admin.series', [
            'series' => $series
        ]);
    }

    public function showSeries($slug){
        $series = Series::where('slug', $slug)->first();
        $series->filepath = url($series->filepath);
        $series->compressed = url($series->compressed);
        $ministers = Minister::orderBy('name', 'asc')->get();
        $messages = $series->messages()->orderBy('date_preached', 'desc')->get();
        foreach($messages as $message){
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->audio_path = url($message->audio_path);
        }
        return view('admin.single_series', [
            'series' => $series,
            'ministers' => $ministers,
            'messages' => $messages
        ]);
    }

    public function messages(){
        $messages = Message::orderBy('date_preached', 'desc')->paginate(20);
        foreach($messages as $message){
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->audio_path = url($message->audio_path);
        }
        $ministers = Minister::orderBy('name', 'asc')->get();
        $series = Series::orderBy('start_date', 'desc')->get();

        return view('admin.messages', [
            'messages' => $messages,
            'series' => $series,
            'ministers' => $ministers
        ]);
    }

    public function showMessage($slug){
        $message = Message::where('slug', $slug)->first();
        if(!empty($message->series_id)){
            $series = $message->series()->first();
            $series->filepath = url($series->filepath);
            $series->compressed = url($series->compressed);            
            $message->series = $series;
        }
        $minister = $message->minister()->first();
        $minister->filepath = url($minister->filepath);
        $minister->compressed = url($minister->compressed);
        $message->image_path = url($message->image_path);
        $message->audio_path = url($message->audio_path);
        $message->compressed_image = url($message->compressed_image);
        $message->minister = $minister;

        $ministers = Minister::orderBy('name', 'asc')->get();
        $series = Series::orderBy('start_date', 'desc')->get();

        return view('admin.message', [
            'message' => $message,
            'series' => $series,
            'ministers' => $ministers
        ]);
    }

    public function devotionals(){
        $devotionals = Devotional::orderBy('devotional_date', 'desc')->paginate(20);
        foreach($devotionals as $devotional){
            $devotional->minister = Minister::find($devotional->minister_id);
        }
        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.devotionals', [
            'devotionals' => $devotionals,
            'ministers' => $ministers
        ]);
    }

    public function devotional($slug){
        $devotional = Devotional::where('slug', $slug)->first();
        $devotional->minister = Minister::find($devotional->minister_id);

        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.devotional', [
            'devotional' => $devotional,
            'ministers' => $ministers
        ]);
    }

    public function books(){
        $books = Book::orderBy('created_at', 'desc')->paginate(20);
        foreach($books as $book){
            $book->book_path = url($book->book_path);
            $book->image_path = url($book->image_path);
            $book->compressed_image = url($book->compressed_image);
            $book->author = $book->author();
        }
        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.books', [
            'books' => $books,
            'ministers' => $ministers
        ]);
    }

    public function book($slug){
        $book = Book::where('slug', $slug)->first();
        $book->book_path = url($book->book_path);
        $book->image_path = url($book->image_path);
        $book->compressed_image = url($book->compressed_image);
        $book->author = $book->author();
        $book->author->filepath = url($book->author->filepath);
        $ministers = Minister::orderBy('name', 'asc')->get();

        return view('admin.book', [
            'book' => $book,
            'ministers' => $ministers
        ]);
    }

    public function magazines(){
        $magazines = Magazine::orderBy('created_at', 'desc')->paginate(20);
        foreach($magazines as $magazine){
            $magazine->image_path = url($magazine->image_path);
            $magazine->compressed = url($magazine->compressed);
            $magazine->document_path = url($magazine->document_path);
        }

        return view('admin.magazines', [
            'magazines' => $magazines
        ]);
    }

    public function magazine($slug){
        $magazine = Magazine::where('slug', $slug)->first();
        $magazine->image_path = url($magazine->image_path);
        $magazine->compressed = url($magazine->compressed);
        $magazine->document_path = url($magazine->document_path);

        return view('admin.magazine', [
            'magazine' => $magazine
        ]);
    }

    public function videos(){
        $videos = Video::orderBy('created_at', 'desc')->paginate(20);
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        return view('admin.videos', [
            'videos' => $videos,
            'page' => $page
        ]);
    }

    public function articles(){
        $articles = Article::orderBy('created_at', 'desc')->paginate(20);
        foreach($articles as $article){
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
        }
        return view('admin.articles', [
            'articles' => $articles
        ]);
    }

    public function article($slug){
        $article = Article::where('slug', $slug)->first();
        $article->image_path = url($article->image_path);
        $article->compressed_image = url($article->compressed_image);

        return view('admin.article', [
            'article' => $article
        ]);
    }

    public function photos(){
        $photos = Photo::orderBy('created_at', 'desc')->paginate(20);
        foreach($photos as $photo){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
        }
        return view('admin.photos', [
            'photos' => $photos
        ]);
    }

    public function photo($slug){
        $photo = Photo::where('slug', $slug)->first();
        $photo->filepath = url($photo->filepath);
        $photo->compressed = url($photo->compressed);
        return view('admin.photo', [
            'photo' => $photo
        ]);
    }

    public function page_headers(){
        $page_headers = PageHeader::orderBy('page', 'asc')->get();
        foreach($page_headers as $page){
            $page->filename = url($page->filename);
        }
        //print_r($headers);
        return view('admin.page_headers', [
            'page_headers' => $page_headers
        ]);
    }

    public function events(){
        $events = Event::orderBy('created_at', 'desc')->paginate(20);
        foreach($events as $event){
            $event->filename = url($event->filename);
            $event->compressed = url($event->compressed);
        }

        return view('admin.events', [
            'events' => $events
        ]);
    }

    public function event($slug){
        $event = Event::where('slug', $slug)->first();
        $event->filename = url($event->filename);
        $event->compressed = url($event->compressed);

        return view('admin.event', [
            'event' => $event
        ]);
    }
}
