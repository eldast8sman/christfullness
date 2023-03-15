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
        $header = PageHeader::where('page', 'books')->first();
        $header->filename = url($header->filename);

        $search_param = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        if(!empty($search_param)){
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $found = [];
            $search_array = explode(' ', $search_param);
            foreach($search_array as $search){
                $search = strtolower($search);
                if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
                && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
                && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                    $books = Book::where('details', 'like', '%'.$search.'%')->get();
                    if(!empty($books)){
                        foreach($books as $book){
                            if(isset($found[$book->id])){
                                $found[$book->id] = $found[$book->id] + 1;
                            } else {
                                $found[$book->id] = 1;
                            }
                        }
                    }
                }
            }

            if(!empty($found)){
                arsort($found);
                $keys = array_keys($found);
                $books = [];
                foreach($keys as $id){
                    if(!empty($book = Book::find($id))){
                        $books[] = $book;
                    }
                }

                if(!empty($books)){
                    $books = self::paginate_array($books, 30, $page, []);
                    foreach($books as $book){
                        $book->book_path = url($book->book_path);
                        $book->image_path = url($book->image_path);
                        $book->compressed_image = url($book->compressed_image);
                        $book->author = $book->author();
                    }
                }
            } else {
                $books = [];
            }

            return view('books', [
                'books' => $books,
                'header' => $header,
                'search' => $search_param
            ]);
        } else {
            $books = Book::orderBy('created_at', 'desc')->paginate(30);
            if(!empty($books)){
                foreach($books as $book){
                    $book->book_path = url($book->book_path);
                    $book->image_path = url($book->image_path);
                    $book->compressed_image = url($book->compressed_image);
                    $book->author = $book->author();
                }
            }

            return view('books', [
                'books' => $books,
                'header' => $header,
                'search' => $search_param
            ]);
        }
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
        $header = PageHeader::where('page', 'magazines')->first();
        $header->filename = url($header->filename);

        $today = date('Y-m-d');

        $search_param = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        if(!empty($search_param)){
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $found = [];
            $search_array = explode(' ', $search_param);
            foreach($search_array as $search){
                $search = strtolower($search);
                if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
                && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
                && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                    $magazines = Magazine::where('all_details', 'like', '%'.$search.'%')->get();
                    if(!empty($magazines)){
                        foreach($magazines as $magazine){
                            if(isset($found[$magazine->id])){
                                $found[$magazine->id] = $found[$magazine->id] + 1;
                            } else {
                                $found[$magazine->id] = 1;
                            }
                        }
                    }
                }
            }

            if(!empty($found)){
                arsort($found);
                $keys = array_keys($found);
                $magazines = [];
                foreach($keys as $id){
                    if(!empty($magazine = Message::find($id))){
                        $magazines[] = $magazine;
                    }
                }

                if(!empty($magazines)){
                    $magazines = self::paginate_array($magazines, 30, $page, []);
                    foreach($magazines as $magazine){
                        $magazine->image_path = url($magazine->image_path);
                        $magazine->compressed = url($magazine->compressed);
                        $magazine->document_path = url($magazine->document_path);
                        $magazine->publication_date = date('l, jS \of F, Y', strtotime($magazine->publication_date));
                    }
        
                    return view('magazines', [
                        'magazines' => $magazines,
                        'header' => $header,
                        'search' => $search_param
                    ]);
                }
            } else {
                $magazines = [];
            }
        } else {
            $magazines = Magazine::where('publication_date', '<=', $today)->paginate(30);
            foreach($magazines as $magazine){
                $magazine->image_path = url($magazine->image_path);
                $magazine->compressed = url($magazine->compressed);
                $magazine->document_path = url($magazine->document_path);
                $magazine->publication_date = date('l, jS \of F, Y', strtotime($magazine->publication_date));
            }

            return view('magazines', [
                'magazines' => $magazines,
                'header' => $header,
                'search' => $search_param
            ]);
        }
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
        $header = PageHeader::where('page', 'message series')->first();
        $header->filename = url($header->filename);

        $search_param = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        if(!empty($search_param)){
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $found = [];
            $search_array = explode(' ', $search_param);
            foreach($search_array as $search){
                $search = strtolower($search);
                if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
                && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
                && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                    $serieses = Series::where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
                    if(!empty($serieses)){
                        foreach($serieses as $series){
                            if(isset($found[$series->id])){
                                $found[$series->id] = $found[$series->id] + 1;
                            } else {
                                $found[$series->id] = 1;
                            }
                        }
                    }
                }
            }

            if(!empty($found)){
                arsort($found);
                $keys = array_keys($found);
                $serieses = [];
                foreach($keys as $id){
                    if(!empty($series = Series::find($id))){
                        $serieses[] = $series;
                    }
                }

                if(!empty($serieses)){
                    $serieses = self::paginate_array($serieses, 30, $page, []);
                    foreach($serieses as $series){
                        $series->filepath = url($series->filepath);
                        $series->compressed = url($series->compressed);
                        $series->start_date =  date('l, jS \of F, Y', strtotime($series->start_date));
                        $series->end_date =  date('l, jS \of F, Y', strtotime($series->end_date));
                    }
                }
            } else {
                $serieses = [];
            }

            return view('message-series', [
                'message_series' => $serieses,
                'header' => $header,
                'search' => $search_param
            ]);
        } else {
            $serieses = Series::orderBy('start_date', 'desc')->orderBy('end_date', 'desc')->paginate(30);
            foreach($serieses as $series){
                $series->filepath = url($series->filepath);
                $series->compressed = url($series->compressed);
                $series->start_date =  date('l, jS \of F, Y', strtotime($series->start_date));
                $series->end_date =  date('l, jS \of F, Y', strtotime($series->end_date));
            }

            return view('message-series', [
                'message_series' => $serieses,
                'header' => $header,
                'search' => $search_param
            ]);
        }
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
        $header = PageHeader::where('page', 'messages')->first();
        $header->filename = url($header->filename);

        $search_param = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        if(!empty($search_param)){
            $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
            $found = [];
            $search_array = explode(' ', $search_param);
            foreach($search_array as $search){
                $search = strtolower($search);
                if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
                && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
                && ($search != 'on') && ($search != 'Rev\'d') && ($search != 'the')){
                    $messages = Message::where('details', 'like', '%'.$search.'%')->get();
                    if(!empty($messages)){
                        foreach($messages as $message){
                            if(isset($found[$message->id])){
                                $found[$message->id] = $found[$message->id] + 1;
                            } else {
                                $found[$message->id] = 1;
                            }
                        }
                    }
                }
            }

            if(!empty($found)){
                arsort($found);
                $keys = array_keys($found);
                $messages = [];
                foreach($keys as $id){
                    if(!empty($message = Message::find($id))){
                        $messages[] = $message;
                    }
                }

                if(!empty($messages)){
                    $messages = self::paginate_array($messages, 30, $page, []);
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
                }
            } else {
                $messages = [];
            }

            return view('messages', [
                'messages' => $messages,
                'header' => $header,
                'search' => $search_param
            ]);
        } else {
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

            return view('messages', [
                'messages' => $messages,
                'header' => $header,
                'search' => $search_param
            ]);
        }
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
