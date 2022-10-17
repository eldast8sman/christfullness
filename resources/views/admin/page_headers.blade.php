@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|Page Headers
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Page Headers
                @endslot
                @slot('page_desc')
                    All the Headers of various Pages
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Components</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Page Headers</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Page Headers
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add_pageheader_modal">Add Page Header</button>
                            </p>
                            <div class="row">
                                @foreach ($headers as $header)
                                    <div class="col-lg-6 col-md-12">
                                        @component('admin.components.cards')
                                            @slot('title')
                                                {{ $header->page }}
                                            @endslot
                                            @slot('body')
                                                <img src="{{ $header->filename }}" alt="{{ $header->page }}" style="width: 100%; height: auto">
                                                <p class="col-12">
                                                    <h3 class="text-dark">{{ $header->title }}</h3>
                                                </p>
                                                <p class="col-12">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_pageheader_modal_{{ $header->id }}">Edit</button>
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_pageheader_modal_{{ $header->id }}">Delete</button>
                                                </p>
                                                @component('admin.components.long_modal')
                                                    @slot('modal_id')
                                                        edit_pageheader_modal_{{ $header->id }}
                                                    @endslot
                                                    @slot('modal_title')
                                                        Edit Page Header
                                                    @endslot
                                                    @slot('modal_body')
                                                        <div class="col-12 py-3">
                                                            @component('')
                                                                @slot('data_id')
                                                                    {{ $header->id }}
                                                                @endslot
                                                                @slot('page_value')
                                                                    {{ $header->page }}
                                                                @endslot
                                                                @slot('title_value')
                                                                    {{ $header->title }}
                                                                @endslot
                                                            @endcomponent
                                                        </div>
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
                                                        Do you really want to delete {{ $header->page }} as a Page Header from this App? <br />
                                                        Please note that this is not reversible
                                                        <p class="text-center">
                                                            <button class="btn btn-danger mt-4 delete_pageheader" data-id="{{ $header->id }}">Delete</button>
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
                                    add_pageheader_modal
                                @endslot
                                @slot('modal_title')
                                    Add Page Header
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.header_form')
                                            @slot('data_id')
                                                
                                            @endslot
                                            @slot('page_value')
                                                
                                            @endslot
                                            @slot('title_value')
                                                
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