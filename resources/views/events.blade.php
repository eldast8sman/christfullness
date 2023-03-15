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
                <p>All Upcoming and Past Events</p>

                @component('components.search_bar')
                    @slot('search_id')
                        events_search                       
                    @endslot
                    @slot('placeholder')
                        Search Events
                    @endslot
                    @slot('submit_id')
                        events_search_submit
                    @endslot
                    @slot('search_value')
                        {{ $search }}
                    @endslot
                @endcomponent
            </div>

            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 wow fadeInUp rounded" data-wow-delay="0.1s">
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <div style="height:350px; background-image:url({{ $event->filename }}); background-size:contain; background-position: center center; background-repeat: no-repeat"></div>
                            <p>
                                <h5>{{ $event->event }}</h5>  
                                <hr>
                                <small class="me-3"><i class="fa fa-info text-primary me-2"></i>{{ $event->theme }}</small>
                                <br>
                                <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>{{ $event->start_date }}</small>
                            </p>
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ env('APP_URL') }}/events/{{ $event->slug }}">More Details</a>
                        </div>
                    </div> 
                @endforeach
            </div>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    
@endsection