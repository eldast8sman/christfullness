@extends('layouts.app')

@section('title')
    CFCI || Videos
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
            <li class="breadcrumb-item text-dark active" aria-current="page">Videos</li>
        @endslot
    @endcomponent

    <div class="container-fluid bg-light bg-icon my-5 py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5">Videos</h1>
                <p>All Uploaded Videos</p>

                @component('components.search_bar')
                    @slot('search_id')
                        videos_search                       
                    @endslot
                    @slot('placeholder')
                        Search Videos
                    @endslot
                    @slot('submit_id')
                        videos_search_submit
                    @endslot
                @endcomponent
            </div>
            <div class="row g-4">
                @foreach ($videos as $video)
                    <div class="col-lg-4 col-md-6 wow fadeInUp rounded" data-wow-delay="0.1s">
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <h5>{{ $video->title }}</h5>
                            <p>
                                <iframe 
                                    width="100%" 
                                    height="auto" 
                                    src="{{ $video->output_link }}" 
                                    title="{{ $video->slug }}" 
                                    frameborder="0" 
                                    allow="
                                        accelerometer; 
                                        autoplay; 
                                        clipboard-write; 
                                        encrypted-media; 
                                        gyroscope; 
                                        picture-in-picture
                                        " 
                                    allowfullscreen
                                ></iframe>
                            </p>
                            <p>{!! nl2br($video->details) !!}</p>
                        </div>
                    </div>   
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $videos->links() }}
            </div>
        </div>
    </div>
@endsection