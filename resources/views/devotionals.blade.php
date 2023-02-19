@extends('layouts.app')

@section('title')
    CFCI || Devotionals
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/devotionals">Devotionals</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $today }}</li>
        @endslot
    @endcomponent

    @if (!empty($today_devotional))
        <div class="container-xxl py-6">
            <div class="container">
                <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Today's Devotional</h1>
                    <p>{{ $today }}</p>
                </div>
                <div class="row g-5 align-items-center">
                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="display-9 mb-4 text-center">{{ $today_devotional->topic }}</h3>
                        <h5 class="text-center">{{ $today_devotional->bible_text }}</h5>

                        <div class="col-lg-9 col-md-12 mx-auto">
                            <p class="text-center">
                                <strong>Memory Verse</strong>
                                <br>
                                <i>{{ $today_devotional->memory_verse }}</i>
                                <br>
                                {{ $today_devotional->memory_verse_text }}
                            </p>

                            <p class="text-justify" style="text-align: justify">
                                <blockquote>{!! nl2br($today_devotional->devotional) !!}</blockquote>
                            </p>
                            <p>
                                <strong>Further Reading</strong>
                                <br>
                                {!! nl2br($today_devotional->further_reading) !!}
                            </p>
                            <p>
                                <strong>Prayers</strong>
                                <br>
                                {!! nl2br($today_devotional->prayers) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (!empty($previous_devs))
        <div class="container-fluid bg-light bg-icon my-5 py-6">
            <div class="container">
                <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
                    <h1 class="display-6 mb-3">Previous Devotionals</h1>
                </div>
                <div class="row g-4">
                    @foreach ($previous_devs as $devotional)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="bg-white text-center h-100 p-4 p-xl-5">
                                {{-- <img class="img-fluid mb-4" src="img/icon-1.png" alt=""> --}}
                                <h5 class="mb-3">{{ $devotional->devotional_date }}</h5>
                                <h4 class="mb-3">{{ $devotional->topic }}</h4>
                                <p class="mb-4">{{ $devotional->memory_verse }}</p>
                                <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ env('APP_URL') }}/publications/devotionals/{{ $devotional->slug }}">Read More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row" style="text-align: center">
            <div class="col-12" style="text-align: center">
                <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ env('APP_URL') }}/publications/devotional/archive">Devotional Archive</a>
            </div>
        </div>
    @endif
@endsection