<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Book;
use App\Models\About;
use App\Models\Event;
use App\Models\Photo;
use App\Models\Quote;
use App\Models\Video;
use App\Models\Series;
use App\Models\Article;
use App\Models\Message;
use App\Models\Magazine;
use App\Models\Devotional;
use App\Models\HomeBanner;
use App\Models\HomeSlider;
use App\Models\PageHeader;
use Illuminate\Http\Request;
use App\Models\WelcomeMessage;

class PageController extends Controller
{
    public function index(){
        $first_slider = HomeSlider::orderBy('position', 'asc')->first();
        $first_slider->filename = url($first_slider->filename);
        $first_slider->compressed = url($first_slider->compressed);
        $other_sliders = HomeSlider::where('id', '<>', $first_slider->id)->orderBy('position', 'asc')->get();
        foreach($other_sliders as $slider){
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
        $devotionals = Devotional::where('devotional_date', '<=', date('Y-m-d'))->orderBy('devotional_date', 'desc')->limit(3)->get();
        if(!empty($devotionals)){
            foreach($devotionals as $devotional){
                $exploded = explode(' ', $devotional->devotional);
                $dev_array = [];
                for($i=0; $i<=14; $i++){
                    $dev_array[] = $exploded[$i];
                }
                $devotional->devotional = join(' ', $dev_array);
                $devotional->devotional_date = date('l, jS \of F, Y', strtotime($devotional->devotional_date));
            }
        }
        $messages = Message::orderBy('date_preached', 'desc')->limit(8)->get();
        if(!empty($messages)){
            foreach($messages as $message){
                $message->image_path = url($message->image_path);
                $message->compressed_image = url($message->compressed_image);
            }
        }
        $banner = HomeBanner::first();
        if(!empty($banner)){

        } else {
            $banner = new stdClass();
            $banner->title = "";
            $banner->content = "";
            $banner->link = "";
            $banner->call_to_action = "";
        }
        $quotes = Quote::orderBy('created_at', 'asc')->get();
        foreach($quotes as $quote){
            $quote->filename = url($quote->filename);
            $quote->compressed = url($quote->compressed);
        }
        $articles = Article::orderBy('created_at', 'desc')->limit(3)->get();
        foreach($articles as $article){
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
        }
        return view('index', [
            'first_slider' => $first_slider,
            'sliders' => $other_sliders,
            'welcome' => $welcome,
            'devotionals' => $devotionals,
            'messages' => $messages,
            'banner' => $banner,
            'quotes' => $quotes,
            'articles' => $articles
        ]);
    }

    public function about_us(){
        $abouts = About::orderBy('position', 'asc')->orderBy('updated_at', 'desc')->get();
        foreach($abouts as $about){
            if(!empty($about->filename)){
                $about->filename = url($about->filename);
                $about->compressed = url($about->compressed);
            }
        }
        $header = PageHeader::where('page', 'About Us')->first();
        $header->filename = url($header->filename);
        return view('about_us', [
            'abouts' => $abouts,
            'header' => $header
        ]);
    }

    public function events(){
        $events = Event::orderBy('start_date', 'desc')->orderBy('end_date', 'desc')->paginate(2);
        foreach($events as $event){
            $event->filename = url($event->filename);
            $event->compressed = url($event->compressed);
            $event->start_date = date('jS F, Y', strtotime($event->start_date));
            if(!empty($event->end_date)){
                $event->end_date = date('jS F, Y', strtotime($event->end_date));
            } else {
                $event->end_date = "";
            }
        }
        $header = PageHeader::where('page', 'Events')->first();
        $header->filename = url($header->filename);
        return view('events', [
            'events' => $events,
            'header' => $header
        ]);
    }

    public function event($slug){
        $event = Event::where('slug', $slug)->first();
        $event->filename = url($event->filename);
        $event->start_date = date('l, jS \of F, Y', strtotime($event->start_date));
        if(!empty($event->end_date)){
            $event->end_date = date('l, jS \of F, Y', strtotime($event->end_date));
        } else {
            $event->end_date = "";
        }
        
        $header = PageHeader::where('page', 'Events')->first();
        $header->filename = url($header->filename);
        return view('event', [
            'event' => $event,
            'header' => $header
        ]);
    }

    public function devotionals(){
        $today_date = date('Y-m-d');
        $todays_dev = Devotional::where('devotional_date', $today_date)->first();
        if(!empty($todays_dev)){
            $todays_dev->devotional_date = date('l, jS \of F, Y', strtotime($todays_dev->devotional_date));
            $todays_dev->minister = $todays_dev->minister();
        }
        $today = date('l, jS \of F, Y');

        $previous_devs = Devotional::where('devotional_date', '<', $today_date)->orderBy('devotional_date', 'desc')->limit(6)->get();
        if(!empty($previous_devs)){
            foreach($previous_devs as $devotional){
                $devotional->devotional_date = date('l, jS \of F, Y', strtotime($devotional->devotional_date));
                $devotional->minister = $devotional->minister();
            }
        }

        $header = PageHeader::where('page', 'Devotionals')->first();
        $header->filename = url($header->filename);

        return view('devotionals', [
            'header' => $header,
            'today' => $today,
            'today_devotional' => $todays_dev,
            'previous_devs' => $previous_devs
        ]);
    }

    public function devotional($slug){
        $devotional = Devotional::where('slug', $slug)->first();
        $the_date = $devotional->devotional_date;
        $devotional->devotional_date = date('l, jS \of F, Y', strtotime($devotional->devotional_date));
        $devotional->minister = $devotional->minister();

        $previous_devs = Devotional::where('devotional_date', '<', $the_date)->orderBy('devotional_date', 'desc')->limit(3)->get();
        if(!empty($previous_devs)){
            foreach($previous_devs as $old_dev){
                $old_dev->devotional_date = date('l, jS \of F, Y', strtotime($old_dev->devotional_date));
                $old_dev->minister = $old_dev->minister();
            }
        }
        
        $later_devs = Devotional::where('devotional_date', '>', $the_date)->where('devotional_date', '<=', date('Y-m-d'))->orderBy('devotional_date', 'asc')->limit(3)->get();
        if(!empty($later_devs)){
            foreach($later_devs as $new_dev){
                $new_dev->devotional_date = date('l, jS \of F, Y', strtotime($new_dev->devotional_date));
                $new_dev->minister = $new_dev->minister();
            }
        }

        $today_date = date('l, jS \of F, Y', strtotime($the_date));
        $header = PageHeader::where('page', 'devotionals')->first();
        $header->filename = url($header->filename);

        return view('devotional', [
            'header' => $header,
            'today' => $today_date,
            'today_devotional' => $devotional,
            'previous_devs' => $previous_devs,
            'later_devs' => $later_devs
        ]);
    }

    public function devotional_archive(){
        $today_date = date('Y-m-d');
        $devotionals = Devotional::where('devotional_date', '<=', $today_date)->paginate(15);
        if(!empty($devotionals)){
            foreach($devotionals as $devotional){
                $devotional->devotional_date = date('l, jS \of F, Y', strtotime($devotional->devotional_date));
                $devotional->minister = $devotional->minister();
            }
        }

        $header = PageHeader::where('page', 'devotionals')->first();
        $header->filename = url($header->filename);

        return view('devotional_archive', [
            'devotionals' => $devotionals,
            'header' => $header
        ]);
    }

    public function books(){
        $books = Book::orderBy('created_at', 'desc')->paginate(30);
        if(!empty($books)){
            foreach($books as $book){
                $book->book_path = url($book->book_path);
                $book->image_path = url($book->image_path);
                $book->compressed_image = url($book->compressed_image);
                $book->author = $book->author();
            }
        }

        $header = PageHeader::where('page', 'books')->first();
        $header->filename = url($header->filename);

        return view('books', [
            'books' => $books,
            'header' => $header
        ]);
    }

    public function book($slug){
        $book = Book::where('slug', $slug)->first();
        $book->book_path = url($book->book_path);
        $book->image_path = url($book->image_path);
        $book->compressed_image = url($book->compressed_image);
        $book->author = $book->author();
        $book->author->filepath = url($book->author->filepath);
        $book->author->compressed = url($book->author->compressed);

        $header = PageHeader::where('page', 'books')->first();
        $header->filename = url($header->filename);

        return view('book', [
            'book' => $book,
            'header' => $header
        ]);
    }

    public function magazines(){
        $today = date('Y-m-d');

        $magazines = Magazine::where('publication_date', '<=', $today)->paginate(30);
        foreach($magazines as $magazine){
            $magazine->image_path = url($magazine->image_path);
            $magazine->compressed = url($magazine->compressed);
            $magazine->document_path = url($magazine->document_path);
            $magazine->publication_date = date('l, jS \of F, Y', strtotime($magazine->publication_date));
        }

        $header = PageHeader::where('page', 'magazines')->first();
        $header->filename = url($header->filename);

        return view('magazines', [
            'magazines' => $magazines,
            'header' => $header
        ]);
    }

    public function magazine($slug){
        $magazine = Magazine::where('slug', $slug)->first();
        $magazine->image_path = url($magazine->image_path);
        $magazine->compressed = url($magazine->compressed);
        $magazine->document_path = url($magazine->document_path);
        $magazine->publication_date = date('l, jS \of F, Y', strtotime($magazine->publication_date));

        $header = PageHeader::where('page', 'magazines')->first();
        $header->filename = url($header->filename);
        
        return view('magazine', [
            'magazine' => $magazine,
            'header' => $header
        ]);
    }

    public function articles(){
        $today = date('Y-m-d');

        $articles = Article::where('published', '<=', $today)->paginate(30);
        foreach($articles as $article){
            $article->image_path = url($article->image_path);
            $article->compressed_image = url($article->compressed_image);
            $article->published = date('l, jS \of F, Y', strtotime($article->published));
        }

        $header = PageHeader::where('page', 'articles')->first();
        $header->filename = url($header->filename);

        return view('articles', [
            'articles' => $articles,
            'header' => $header
        ]);
    }

    public function article($slug){
        $article = Article::where('slug', $slug)->first();
        $article->image_path = url($article->image_path);
        $article->compressed_image = url($article->compressed_image);
        $article->published = date('l, jS \of F, Y', strtotime($article->published));

        $header = PageHeader::where('page', 'articles')->first();
        $header->filename = url($header->filename);

        return view('article', [
            'article' => $article,
            'header' => $header
        ]);
    }

    public function message_series(){
        $serieses = Series::orderBy('start_date', 'desc')->orderBy('end_date', 'desc')->paginate(30);
        foreach($serieses as $series){
            $series->filepath = url($series->filepath);
            $series->compressed = url($series->compressed);
            $series->start_date =  date('l, jS \of F, Y', strtotime($series->start_date));
            $series->end_date =  date('l, jS \of F, Y', strtotime($series->end_date));
        }

        $header = PageHeader::where('page', 'message series')->first();
        $header->filename = url($header->filename);

        return view('message-series', [
            'message_series' => $serieses,
            'header' => $header
        ]);
    }

    public function show_series($slug){
        $series = Series::where('slug', $slug)->first();
        $series->filepath = url($series->filepath);
        $series->compressed = url($series->compressed);
        $series->start_date =  date('l, jS \of F, Y', strtotime($series->start_date));
        $series->end_date =  date('l, jS \of F, Y', strtotime($series->end_date));

        $messages = Message::where('series_id', $series->id)->orderBy('date_preached', 'desc')->get();
        if(!empty($messages)){
            foreach($messages as $message){
                $message->date_preached = date('l jS \of F, Y', strtotime($message->date_preached));
                $message->image_path = url($message->image_path);
                $message->compressed_image = url($message->compressed_image);
                $message->minister = $message->minister()->first();
                $message->minister->filepath = url($message->minister->filepath);
                $message->minister->compressed = url($message->minister->compressed);
            }
        }

        $header = PageHeader::where('page', 'message series')->first();
        $header->filename = url($header->filename);
        
        return view('single-series', [
            'series' => $series,
            'messages' => $messages,
            'header' => $header
        ]);
    }

    public function messages(){
        $messages = Message::orderBy('date_preached', 'desc')->orderBy('created_at', 'desc')->paginate(30);
        foreach($messages as $message){
            $message->date_preached = date('l jS \of F, Y', strtotime($message->date_preached));
            $message->image_path = url($message->image_path);
            $message->compressed_image = url($message->compressed_image);
            $message->minister = $message->minister()->first();
            $message->minister->filepath = url($message->minister->filepath);
            $message->minister->compressed = url($message->minister->compressed);
            $message->series = $message->series()->first();
            $message->series->filepath = url($message->series->filepath);
            $message->series->compressed = url($message->series->compressed);
        }

        $header = PageHeader::where('page', 'messages')->first();
        $header->filename = url($header->filename);

        return view('messages', [
            'messages' => $messages,
            'header' => $header
        ]);
    }

    public function message($slug){
        $message = Message::where('slug', $slug)->first();
        $message->date_preached = date('l jS \of F, Y', strtotime($message->date_preached));
        $message->image_path = url($message->image_path);
        $message->compressed_image = url($message->compressed_image);
        $message->audio_path = url($message->audio_path);
        $message->minister = $message->minister()->first();
        $message->minister->filepath = url($message->minister->filepath);
        $message->minister->compressed = url($message->minister->compressed);
        $message->series = $message->series()->first();
        $message->series->filepath = url($message->series->filepath);
        $message->series->compressed = url($message->series->compressed);

        $header = PageHeader::where('page', 'messages')->first();
        $header->filename = url($header->filename);

        return view('message', [
            'message' => $message,
            'header' => $header
        ]);
    }

    public function photos(){
        $photos = Photo::orderBy('created_at', 'desc')->paginate(30);
        foreach($photos as $photo){
            $photo->filepath = url($photo->filepath);
            $photo->compressed = url($photo->compressed);
        }

        $header = PageHeader::where('page', 'photos')->first();
        $header->filename = url($header->filename);

        return view('photos', [
            'photos' => $photos,
            'header' => $header
        ]);
    }

    public function videos(){
        $videos = Video::orderBy('created_at', 'desc')->paginate(30);
        
        $header = PageHeader::where('page', 'videos')->first();
        $header->filename = url($header->filename);

        return view('videos', [
            'videos' => $videos,
            'header' => $header
        ]);
    }

    public function contact_us(){
        $header = PageHeader::where('page', 'contact us')->first();
        $header->filename = url($header->filename);

        return view('contact', [
            'header' => $header
        ]);
    }
}
