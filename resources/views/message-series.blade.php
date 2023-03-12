@extends('layouts.app')

@section('title')
    CFCI || Message Series
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
            <li class="breadcrumb-item text-dark active" aria-current="page">Message Series</li>
        @endslot
    @endcomponent

    <div class="container-fluid bg-light bg-icon my-5 py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5">Message Series</h1>
                <p>All Message Series Preached</p>
                @component('components.search_bar')
                    @slot('search_id')
                        series_search                       
                    @endslot
                    @slot('placeholder')
                        Search Message Series
                    @endslot
                    @slot('submit_id')
                        series_search_submit
                    @endslot
                @endcomponent
            </div>

            <div class="row g-4">
                @foreach ($message_series as $series)
                    <div class="col-lg-4 col-md-6 wow fadeInUp rounded" data-wow-delay="0.1s">
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <div style="height:350px; background-image:url({{ $series->filepath }}); background-size:contain; background-position: center center; background-repeat: no-repeat"></div>
                            <p>
                                <h5>{{ $series->title }}</h5>  
                                <hr>
                                <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>{{ $series->start_date }}</small>
                            </p>
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ env('APP_URL') }}/media/message-series/{{ $series->slug }}">More Details</a>
                        </div>
                </div>   
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $message_series->links() }}
            </div>
        </div>
    </div>
@endsection