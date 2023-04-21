@extends('layouts.admin.backup_app')

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
                                <img src="{{ $series->filepath }}" style="width: 600px; max-width: 90%; height:auto; margin: 0 auto" alt="{{ $series->title }}" />
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>{{ $series->description }}</p>
                                <p>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#add_message_modal">Add Message</button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_series_modal">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_series_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            add_message_modal
                                        @endslot
                                        @slot('modal_title')
                                            Add Message to Series
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col012 py-3">
                                                <input type="hidden" name="series" id="redirect" value="{{ $series->slug }}">
                                                @component('admin.components.message_form')
                                                    @slot('data_id')
                                                        
                                                    @endslot
                                                    @slot('redirect_value')
                                                        {{ $series->slug }}
                                                    @endslot
                                                    @slot('title_value')
                                                        
                                                    @endslot
                                                    @slot('description_value')
                                                        
                                                    @endslot
                                                    @slot('date_preached_value')
                                                        
                                                    @endslot
                                                    @slot('series_options')
                                                        <option value="{{ $series->id }}" selected>{{ $series->title }}</option>
                                                    @endslot
                                                    @slot('minister_options')
                                                        @foreach ($ministers as $minister)
                                                            <option value="{{ $minister->id }}">{{ $minister->name."(".$minister->title.")" }}</option>
                                                        @endforeach
                                                    @endslot
                                                @endcomponent
                                            </div>
                                        @endslot
                                        @slot('modal_footer')
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        @endslot
                                    @endcomponent

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
            @if (!empty($messages))
                @component('admin.components.cards')
                    @slot('title')
                        Messages
                    @endslot
                    @slot('body')
                        <div class="row">
                            @foreach ($messages as $message)
                                <div class="col-lg-3 col-md-4 col-sm-12 mt-3">
                                    @component('admin.components.cards')
                                        @slot('title')
                                            {{ $message->title }}
                                        @endslot
                                        @slot('body')
                                            <div data-toggle="modal" data-target="#series_message_modal">
                                                <div class="col-12" style="height:200px;
                                                                        background-image: url({{ $message->compressed_image }});
                                                                        background-size: cover;
                                                                        background-position: center center;
                                                                        background-repeat: no-repeat"></div>
                                                <div>{{ $message->title }}</div>
                                            </div>
                                            <button class="btn btn-primary show_series_message" data-toggle="modal" data-target="#series_message_modal" data-id="{{ $message->id }}">More Details</button>
                                        @endslot
                                    @endcomponent
                                </div>
                            @endforeach
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    series_message_modal
                                @endslot
                                @slot('modal_title')
                                    
                                @endslot
                                @slot('modal_body')
                                    
                                @endslot
                                @slot('modal_footer')
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                @endslot
                            @endcomponent
                        </div>
                    @endslot
                @endcomponent
            @endif
        </div>
    </div>
@endsection