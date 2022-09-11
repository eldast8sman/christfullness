@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $message->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Messages
                @endslot
                @slot('page_desc')
                    {{ $message->title }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}messages">Messages</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $message->title }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $message->title }}
                        @endslot
                        @slot('body')
                            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $message->image_path }}" alt="{{ $message->tite }}" style="
                                    width: 600px;
                                    max-width: 90%;
                                    height: auto;
                                    margin: 0 auto;
                                ">  
                                <p class="mt-3">
                                    <audio src="{{ $message->audio_path }}" controls></audio>
                                </p>
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>
                                    <strong>Date Preached: </strong>{{ date('l, jS F, Y', strtotime($message->date_preached)) }}
                                </p>
                                <p>{{ $message->description }}</p>
                                <p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_message_modal">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_message_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_message_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Message
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.message_form')
                                                    @slot('data_id')
                                                        {{ $message->id }}
                                                    @endslot
                                                    @slot('title_value')
                                                        {{ $message->title }}
                                                    @endslot
                                                    @slot('description_value')
                                                        {{ $message->description }}
                                                    @endslot
                                                    @slot('date_preached_value')
                                                        {{ $message->date_preached }}
                                                    @endslot
                                                    @slot('series_options')
                                                        @foreach ($series as $ser)
                                                            <option value="{{ $ser->id }}"
                                                                @if ($ser->id == $message->series_id)
                                                                    {{ " selected" }}
                                                                @endif    
                                                            >{{ $ser->title }}</option>
                                                        @endforeach
                                                    @endslot
                                                    @slot('minister_options')
                                                        @foreach ($ministers as $minister)
                                                            <option value="{{ $minister->id }}"
                                                                @if ($minister->id == $message->minister_id)
                                                                    {{ " selected" }}
                                                                @endif    
                                                            >{{ $minister->name."(".$minister->title.")" }}</option>
                                                        @endforeach
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
                                            delete_message_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $message->tite }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $message->title }} as a Message from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $message->id }}" id="delete_message">Delete</button>
                                            </p>
                                        @endslot
                                    @endcomponent
                                </p>
                            </div>
                            <div class="row">
                                @if (!empty($message->series_id))
                                    <div class="col-lg-3 col-md-4 col-sm-6 mx-auto text-justify text-dark">
                                        <h5>Series</h5>
                                        <div class="col-12" style="height: 200px;
                                                                background-image: url({{ $message->series->filepath }});
                                                                background-position: center center;
                                                                background-size: cover;"
                                        ></div>
                                        <p>
                                            <a href="{{ env('ADMIN_URL') }}message-series/{{ $message->series->slug }}" class="text-primary">
                                                <h3>{{ $message->series->title }}</h3>
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                <div class="col-lg-3 col-md-4 col-sm-6 mx-auto text-justify text-dark">
                                    <h5>Minister</h5>
                                    <div class="col-12" style="height: 200px;
                                                                background-image: url({{ $message->minister->filepath }});
                                                                background-position: center center;
                                                                background-size: cover;"
                                        ></div>
                                    <p>
                                        <a href="{{ env('ADMIN_URL') }}ministers/{{ $message->minister->slug }}" class="text-primary">
                                            <h3>{{ $message->minister->title." ".$message->minister->name }}</h3>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection