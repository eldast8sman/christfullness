<?php

namespace App\Http\Controllers;

use stdClass;
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
        return view('index', [
            'first_slider' => $first_slider,
            'sliders' => $other_sliders,
            'welcome' => $welcome
        ]);
    }
}
