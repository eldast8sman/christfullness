@extends('layouts.app')

@section('title')
    CFCI || {{ $article->title }}
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/publications/articles">Articles</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $article->title }}</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Articles</h1>
                <p>{{ $article->title }}</p>
            </div>

            <div class="row g-5 align-items-center">
                <div class="col-lg-10 col-md-12 mx-auto fadeIn" data-wow-delay="0.5s">
                    <h3 class="display-7 mb-4 text-center">{{ $article->title }}</h3>
                    <small class="text-center me-3 text-primary"><center><i class="fa fa-user"></i> {{ $article->author }}</center></small>
                    <small class="text-center me-3 text-primary"><center><i class="fa fa-calendar"></i> {{ $article->published }}</center></small>
                    <div>
                        <center><img src="{{ $article->image_path }}" width="500px" height="auto" style="max-width: 100%; margin:10px auto;" alt="" class="img-fluid"></center>
                        {!! html_entity_decode($article->article) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection