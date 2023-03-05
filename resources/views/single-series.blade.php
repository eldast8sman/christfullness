@extends('layouts.app')

@section('title')
    CFCI || {{ $series->title }}
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
            <li class="breadcrumb-item"><a class="text-body" href="{{ env('APP_URL') }}/media/message-series">Message Series</a></li>
            <li class="breadcrumb-item text-dark active" aria-current="page">{{ $series->title }}</li>
        @endslot
    @endcomponent

    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">{{ $series->title }}</h1>
            </div>

            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img src="{{ $series->filepath }}" alt="{{ $series->title }}" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    @if (!empty($series->start_date))
                        <p>
                            <strong>Start Date: </strong>{{ $series->start_date }}
                        </p>
                    @endif
                    @if (!empty($series->end_date))
                        <p>
                            <strong>Start Date: </strong>{{ $series->end_date }}
                        </p>
                    @endif
                    <p>
                        {!! nl2br($series->description) !!}
                    </p>
                </div>
                @if (!empty($messages))
                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                            <h1 class="display-7 mb-3">Messages In the Series</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-striped text-dark">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Date Preached</th>
                                        <th>Minister</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr class="align-items-center">
                                            <td>
                                                <img src="{{ $message->compressed_image }}" alt="{{ $message->title }}" class="img-fluid">
                                            </td>
                                            <td class="align-items-center"><p class="mt-3 py-2">{{ $message->title }}</p></td>
                                            <td class="align-items-center"><p class="mt-3 py-2">{{ $message->date_preached }}</p></td>
                                            <td class="align-items-center"><p class="mt-3 py-2">{{ $message->minister->title.' '.$message->minister->name }}</p></td>
                                            <td class="align-items-center"><a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill mt-3" href="{{ env('APP_URL') }}/media/messages/{{ $message->slug }}">More Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection