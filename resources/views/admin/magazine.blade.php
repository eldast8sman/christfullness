@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $magazine->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Magazines
                @endslot
                @slot('page_desc')
                    {{ $magazine->title }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}magazines">Magazines</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $magazine->title }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $magazine->title }}
                        @endslot
                        @slot('body')
                            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $magazine->image_path }}" alt="{{ $magazine->title }}" style="
                                    width: 600px;
                                    max-width: 90%;
                                    height: auto;
                                    margin: 0 auto;
                                ">
                                <p class="mt-3">
                                    <a href="{{ $magazine->document_path }}" download="{{ $magazine->slug }}" class="text-primary">Download</a>
                                </p>
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>{{ $magazine->summary }}</p>
                                <p>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_magazine_modal">Edit</button>
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_magazine_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_magazine_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Magazine
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.magazine_form')
                                                    @slot('data_id')
                                                        {{ $magazine->id }}
                                                    @endslot
                                                    @slot('title_value')
                                                        {{ $magazine->title }}
                                                    @endslot
                                                    @slot('publication_date')
                                                        {{ $magazine->publication_date }}
                                                    @endslot
                                                    @slot('summary_value')
                                                        {{ $magazine->summary }}
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
                                            delete_magazine_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $magazine->tite }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $magazine->title }} as a Magazine from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $magazine->id }}" id="delete_magazine">Delete</button>
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