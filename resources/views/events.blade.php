@extends('layouts.app')

@section('title')
    CFCI || Events
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
        <li class="breadcrumb-item text-dark active" aria-current="page">Events</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Events</h1>
                <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>

            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid" width="100%" height="auto" src="{{ $event->compressed }}" alt="{{ $event->event }}">
                        <div class="bg-light p-4">
                            <a href="{{ env('APP_URL') }}/events/{{ $event->slug }}" class="d-block h5 lh-base mb-4">{{ $event->event }}</a>
                            <div class="text-muted border-top pt-4">
                                <small class="me-3"><i class="fa fa-info text-primary me-2"></i>{{ $event->theme }}</small>
                                <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>{{ $event->start_date }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    
@endsection