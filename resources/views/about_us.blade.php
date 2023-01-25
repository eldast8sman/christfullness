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
    
@endsection