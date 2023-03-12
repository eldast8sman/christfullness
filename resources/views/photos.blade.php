@extends('layouts.app')

@section('title')
    CFCI || Photos
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
            <li class="breadcrumb-item text-dark active" aria-current="page">Photos</li>
        @endslot
    @endcomponent

    <div class="container-fluid bg-light bg-icon my-5 py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5">Photos</h1>
                <p>All Uploaded Photos</p>

                @component('components.search_bar')
                    @slot('search_id')
                        photo_search                       
                    @endslot
                    @slot('placeholder')
                        Search Photos
                    @endslot
                    @slot('submit_id')
                        photo_search_submit
                    @endslot
                @endcomponent
            </div>
            <div class="row g-4">
                <div class="popup-gallery">
                    @foreach ($photos as $photo)
                        <a href="{{ $photo->filepath }}" title="{{ $photo->caption }}||{{ $photo->details }}"><img src="{{ $photo->compressed }}" alt="{{ $photo->caption }}" height="200px" width="auto" class="m-2"></a>
                    @endforeach
                </div>
            </div>
            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                {{ $photos->links() }}
            </div>
        </div>
    </div>
@endsection