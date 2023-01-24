<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Quote;
use App\Models\Article;
use App\Models\Message;
use App\Models\Devotional;
use App\Models\HomeBanner;
use App\Models\HomeSlider;
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
}
