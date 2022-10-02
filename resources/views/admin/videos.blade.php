@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|Videos
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Videos
                @endslot
                @slot('page_desc')
                    All Videos linked to the Website
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Videos</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Videos
                            <input type="hidden" id="video_page" value="{{ $page }}">
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_video_modal">Add Video</button>
                            </p>
                            <div class="row">
                                @foreach ($videos as $video)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                        @component('admin.components.cards')
                                            @slot('title')
                                                {{ $video->title }}
                                            @endslot
                                            @slot('body')
                                                <iframe 
                                                    width="100%" 
                                                    height="auto" 
                                                    src="{{ $video->output_link }}" 
                                                    title="{{ $video->slug }}" 
                                                    frameborder="0" 
                                                    allow="
                                                        accelerometer; 
                                                        autoplay; 
                                                        clipboard-write; 
                                                        encrypted-media; 
                                                        gyroscope; 
                                                        picture-in-picture
                                                        " 
                                                    allowfullscreen
                                                ></iframe>
                                                <div class="col-12 py-2" style="overflow: auto; height: 200px">{!! nl2br($video->details) !!}</div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_video_modal_{{ $video->id }}">Edit</button>
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_video_modal_{{ $video->id }}">Delete</button>
                                                </div>

                                                @component('admin.components.long_modal')
                                                    @slot('modal_id')
                                                        edit_video_modal_{{ $video->id }}
                                                    @endslot
                                                    @slot('modal_title')
                                                        Edit Video
                                                    @endslot
                                                    @slot('modal_body')
                                                        <div class="col-12 py-3">
                                                            @component('admin.components.video_form')
                                                                @slot('data_id')
                                                                    {{ $video->id }}
                                                                @endslot
                                                                @slot('title_value')
                                                                    {{ $video->title }}
                                                                @endslot
                                                                @slot('platform_options')
                                                                    <option value="YouTube" selected>YouTube</option>
                                                                @endslot
                                                                @slot('link_value')
                                                                    {{ $video->link }}
                                                                @endslot
                                                                @slot('video_details_value')
                                                                    {{ $video->details }}
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
                                                        delete_video_modal_{{ $video->id }}
                                                    @endslot
                                                    @slot('modal_title')
                                                        Delete {{ $video->tite }}
                                                    @endslot
                                                    @slot('modal_body')
                                                        Do you really want to delete {{ $video->title }} as a Video from this App? <br />
                                                        Please note that this is not reversible
                                                        <p class="text-center">
                                                            <button class="btn btn-danger mt-4 delete_video" data-id="{{ $video->id }}">Delete</button>
                                                        </p>
                                                    @endslot
                                                @endcomponent
                                            @endslot
                                        @endcomponent
                                    </div>
                                @endforeach
                            </div>
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_video_modal
                                @endslot
                                @slot('modal_title')
                                    Add Video
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.video_form')
                                            @slot('data_id')
                                                
                                            @endslot
                                            @slot('title_value')
                                                
                                            @endslot
                                            @slot('platform_options')
                                                <option value="YouTube" selected>YouTube</option>
                                            @endslot
                                            @slot('link_value')
                                                
                                            @endslot
                                            @slot('video_details_value')
                                                
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