@extends('layouts.app')

@section('title')
    CFCI || Devotional Archive
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/publications/devotionals">Devotionals</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">Devotional Archive</li>
        @endslot
    @endcomponent

    <div class="container-fluid bg-light bg-icon my-5 py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
                <h1 class="display-5 mb-3">Devotional Archive</h1>
                <p>All Previous Devotionals</p>
            </div>
            <div class="row g-4">
                @foreach ($devotionals as $devotional)
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
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $devotionals->links() }}
            </div>
        </div>
    </div>

@endsection