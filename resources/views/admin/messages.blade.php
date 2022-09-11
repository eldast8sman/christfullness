@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|Messages
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Messages
                @endslot
                @slot('page_desc')
                    All the uploaded Messages 
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Messages</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Messages
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_message_modal">Add Message</button>
                            </p>
                            <div class="row">
                                @foreach ($messages as $message)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col">
                                        <a href="{{ env('ADMIN_URL') }}messages/{{ $message->slug }}">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    
                                                @endslot
                                                @slot('body')
                                                    <div style="
                                                        height: 200px; 
                                                        background-image: url({{ $message->compressed_image }});
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        margin: 0 auto;
                                                    "></div>
                                                    <div class="mt-2" style="height: 80px">
                                                        <h6 class="text-primary">{{ $message->title }}</h6>
                                                        <i>{{ $message->minister->name }}</i>
                                                    </div>
                                                @endslot
                                            @endcomponent
                                        </a>
                                    </div>
                                @endforeach
                                
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{ $messages->links(); }}
                                </div>
                            </div>
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_message_modal
                                @endslot
                                @slot('modal_title')
                                    Add Message
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.message_form')
                                            @slot('data_id')
                                                
                                            @endslot
                                            @slot('title_value')
                                                
                                            @endslot
                                            @slot('description_value')
                                                
                                            @endslot
                                            @slot('date_preached_value')
                                                
                                            @endslot
                                            @slot('series_options')
                                                @foreach ($series as $ser)
                                                    <option value="{{ $ser->id }}">{{ $ser->title }}</option>
                                                @endforeach
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
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection