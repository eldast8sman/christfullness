@extends('layouts.app')

@section('title')
    CFCI || About Us
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
            <li class="breadcrumb-item text-dark active" aria-current="page">About Us</li>
        @endslot
    @endcomponent

    @foreach ($abouts as $about)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    @if (!empty($about->filename))
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="about-img position-relative overflow-hidden p-5 pe-0">
                                <img class="img-fluid w-100" src="{{ $about->filename }}" alt="{{ $about->heading }}">
                            </div>
                        </div>   
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <h1 class="display-5 mb-4">{{ $about->heading }}</h1>
                            <p class="mb-4">{!! $about->content !!}</p>
                        </div>   
                    @else
                       <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <h1 class="display-5 mb-4">{{ $about->heading }}</h1>
                            <p class="mb-4">{!! $about->content !!}</p>
                        </div> 
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    
@endsection