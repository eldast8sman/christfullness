@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|About Us
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    About Us
                @endslot
                @slot('page_desc')
                    A Section of About Us
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Messages</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                       @slot('title')
                           About Us Sections
                       @endslot 
                       @slot('body')
                            <p class="py-3">
                                <button class="btn btn-primary" data-toggle="modal" data-toggle="#add_about_modal">Add Section</button>
                            </p>
                            <div class="row">
                                @foreach ($abouts as $about)
                                    <div class="col-12">
                                        @component('admin.components.cards')
                                            @slot('title')
                                                {{ $about->heading }}
                                            @endslot
                                            @slot('body')
                                                <p>
                                                    @if(!empty($about->filename))
                                                        <img src="{{ $about->filename }}" alt="{{ $about->heading }}" style="width: 400px; max-width:80%; margin: 0 auto">
                                                        <br />
                                                        <center>
                                                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_about_photo_modal_{{ $about->id }}">Delete Image</button>
                                                        </center>
                                                        @component('admin.components.small_modal')
                                                            @slot('modal_id')
                                                                delete_about_photo_modal_{{ $about->id }}
                                                            @endslot
                                                            @slot('modal_title')
                                                                Delete About Photo
                                                            @endslot
                                                            @slot('modal_body')
                                                                Do you really want to delete this About Photo?
                                                                <br>
                                                                Please note that this is not reversible
                                                                <p class="text-center">
                                                                    <button class="btn btn-danger mt-4 delete_about_photo" data-id="{{ $about->id }}">Delete photo</button>
                                                                </p>
                                                            @endslot
                                                        @endcomponent
                                                    @endif
                                                    {!! $about->content !!}
                                                    <p>
                                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_about_modal_{{ $about->id }}">Edit</button>
                                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_about_modal_{{ $about->id }}">Delete</button>
                                                    </p>
                                                    @component('admin.components.long_modal')
                                                        @slot('modal_id')
                                                            edit_about_modal
                                                        @endslot
                                                        @slot('modal_title')
                                                            Edit About Us Section
                                                        @endslot
                                                        @slot('modal_body')
                                                            <div class="col-12 py-3">
                                                                @component('admin.components.about_us_form')
                                                                    @slot('data_id')
                                                                        {{ $about->id }}
                                                                    @endslot
                                                                    @slot('select_options')
                                                                        @for ($i = 1; $i <= $about_count; $i++)
                                                                            <option value="{{ $i }}"
                                                                                @if ($i == $about->position)
                                                                                    {{ " selected" }}
                                                                                @endif
                                                                            >{{ $i }}</option>
                                                                        @endfor
                                                                    @endslot
                                                                    @slot('heading_value')
                                                                        {{ $about->heading }}
                                                                    @endslot
                                                                    @slot('content_value')
                                                                        {{ $about->content }}
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
                                                            delete_about_modal_{{ $about->id }}
                                                        @endslot
                                                        @slot('modal_title')
                                                            Delete {{ $about->heading }}
                                                        @endslot
                                                        @slot('modal_body')
                                                            Do you really want to delete {{ $about->heading }} as an About Us Section from this App? <br />
                                                            Please note that this is not reversible
                                                            <p class="text-center">
                                                                <button class="btn btn-danger mt-4 delete_about" data-id="{{ $about->id }}">Delete</button>
                                                            </p>
                                                        @endslot
                                                    @endcomponent
                                                </p>
                                                <p class="col-12">
                                                    @if (!empty($about->filename))
                                                        b
                                                    @endif
                                                </p>
                                            @endslot
                                        @endcomponent
                                    </div>
                                @endforeach
                            </div>

                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_about_modal
                                @endslot
                                @slot('modal_title')
                                    Add About Us Section
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.about_us_form')
                                            @slot('data_id')
                                                
                                            @endslot
                                            @slot('select_options')
                                                @for ($i = 1; $i <= $about_count+1; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            @endslot
                                            @slot('heading_value')
                                                
                                            @endslot
                                            @slot('content_value')
                                                
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