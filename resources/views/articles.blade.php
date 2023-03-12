@extends('layouts.app')

@section('title')
    CFCI || Articles
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
            <li class="breadcrumb-item text-dark active" aria-current="page">Articles</li>
        @endslot
    @endcomponent

    <div class="container-fluid bg-light bg-icon my-5 py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Articles</h1>
                <p>All available Articles</p>

                @component('components.search_bar')
                    @slot('search_id')
                        articles_search                       
                    @endslot
                    @slot('placeholder')
                        Search Articles
                    @endslot
                    @slot('submit_id')
                        articles_search_submit
                    @endslot
                @endcomponent
            </div>

            <div class="row g-4">
                @foreach ($articles as $article)
                <div class="col-lg-4 col-md-6 wow fadeInUp rounded" data-wow-delay="0.1s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <div style="height:350px; background-image:url({{ $article->image_path }}); background-size:contain; background-position: center center; background-repeat: no-repeat"></div>
                        <p>
                            <h5>{{ $article->title }}</h5>  
                            <hr>
                            <small class="me-3"><i class="fa fa-user text-primary me-2"></i>{{ $article->author }}</small>
                        </p>
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ env('APP_URL') }}/publications/articles/{{ $article->slug }}">More Details</a>
                    </div>
                </div> 
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection