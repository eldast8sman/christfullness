@extends('layouts.app')

@section('title')
    CFCI || {{ $event->event }}
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/events">Events</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $event->event }}</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">{{ $event->event }}</h1>
                <p>{{ $event->theme }}</p>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="{{ $event->filename }}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="display-9 mb-4">{{ $event->theme }}</h3>
                    <p>
                        <i class="text-primary me-3 fa fa-calendar"></i>
                        <br />
                        {{ $event->start_date }}
                        @if (!empty($event->end_date))
                            {{ " - ".$event->end_date }}
                        @endif
                    </p>
                    <p>
                        <i class="text-primary me-3 fa fa-clock"></i>
                        <br>
                        {!! nl2br($event->timing) !!}
                    </p>
                    <p>
                        <i class="text-primary me-3 fa fa-home"></i>
                        <br>
                        {!! nl2br($event->venue) !!}
                    </p>
                    <p>
                        <i class="text-primary me-3 fa fa-info"></i>
                        <br>
                        {!! nl2br($event->details) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection