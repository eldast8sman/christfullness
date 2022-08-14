@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $series->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Message Series
                @endslot
                @slot('page_desc')
                    {{ $series->title }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}message-series">Message Series</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $series->title }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $series->title }}
                        @endslot             
                        @slot('body')
                            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $series->filepath }}" style="width: 600px; max-width: 90%; height:auto; margin: 0 auto" />
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>{{ $series->description }}</p>
                                <p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_series_modal">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_series_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_series_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Message Series
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                <input type="hidden" id="series_id" value="{{ $series->id }}" />
                                                @component('admin.components.series_form')
                                                    @slot('action')
                                                        update
                                                    @endslot
                                                    @slot('title_value')
                                                        {{ $series->title }}
                                                    @endslot
                                                    @slot('description_value')
                                                        {{ $series->description }}
                                                    @endslot
                                                    @slot('start_date_value')
                                                        {{ $series->start_date }}
                                                    @endslot
                                                    @slot('end_date_value')
                                                        {{ $series->end_date }}
                                                    @endslot
                                                @endcomponent
                                            </div>
                                        @endslot
                                        @slot('modal_footer')
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        @endslot
                                    @endcomponent

                                    @component('admin.components.small_modal')
                                        @slot('modal_id')
                                            delete_series_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $series->tite }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $series->title }} as a Message Series from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $series->id }}" id="delete_series">Delete</button>
                                            </p>
                                        @endslot
                                    @endcomponent
                                </p>
                            </div>
                        @endslot           
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection