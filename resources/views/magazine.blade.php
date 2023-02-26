@extends('layouts.app')

@section('title')
    CFCI || {{ $magazine->title }}
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/publications/magazines">Magazines</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $magazine->title }}</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">{{ $magazine->title }}</h1>
            </div>

            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="{{ $magazine->image_path }}">
                    </div>
                    <center><a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill mt-3" href="{{ env('APP_URL') }}/downloads/magazines/{{ $magazine->slug }}">Download <i class="fa fa-download"></i></a></center>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p><strong>Publication Date: </strong>{{ $magazine->publication_date }}</p>
                    <p>{!! nl2br($magazine->summary) !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection