@extends('layouts.app')

@section('title')
    CFCI || {{ $message->title }}
@endsection

@section('content')
    @component('components.page_header')
        @slot('background_image')
            {{ $header->filename }}
        @endslot
        @slot('page_name')
            {{ $header->title }}
        @endslot
        @slot('breadcrumbs')
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/media/messages">Messages</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $message->title }}</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">{{ $message->title }}</h1>
                <p class="text-primary"><i class="fa fa-calendar"></i> {{ $message->date_preached }}</p>
            </div>

            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="{{ $message->image_path }}" alt="{{ $message->title }}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p>
                        <strong>Series: </strong>
                        <a href="{{ env('APP_URL') }}/media/message-series/{{ $message->series->slug }}" class="text-primary">{{ $message->series->title }}</a>
                    </p>
                    <p>{!! nl2br($message->description) !!}</p>
                    <p>
                        <center><h4 class="text-primary">Minister</h4></center>
                        <img src="{{ $message->minister->filepath }}" alt="{{ $message->minister->name }}" height="70px" style="border-radius: 10px; float: left; margin-right: 20px; margin-bottom: 20px;">
                        <h5 class="text-primary">{{ $message->minister->title." ".$message->minister->name }}</h6>
                        <strong class="text-primary">{{ $message->minister->position }}</strong>
                        <br>
                        <span class="text-primary">{!! nl2br($message->minister->about) !!}</span>
                    </p>
                    <p>
                        <span>
                            <audio controls controlsList="nodownload" class="mt-3">
                                <source src="{{ $message->audio_path }}">
                            </audio>
                        </span>
                        <br>
                        <span><a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill mt-3" href="{{ env('APP_URL') }}/downloads/messages/{{ $message->slug }}">Download <i class="fa fa-download"></i></a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection