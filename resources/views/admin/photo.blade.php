@extends('layouts.admin.backup_app')

@section('title')
    CFCI ADMIN|{{ $photo->caption }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Photos
                @endslot
                @slot('page_desc')
                    {{ $photo->caption }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}photos">Photos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $photo->caption }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $photo->caption }}
                        @endslot
                        @slot('body')
                        <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                            <img src="{{ $photo->filepath }}" alt="{{ $photo->caption }}" style="
                                width: 600px;
                                max-width: 90%;
                                height: auto;
                                margin: 0 auto;
                            ">
                            <p class="my-4 text-dark text-justify">{!! nl2br($photo->details) !!}</p>
                            <p class="mt-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_photo_modal">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_photo_modal">Delete</button>

                                @component('admin.components.long_modal')
                                    @slot('modal_id')
                                        edit_photo_modal
                                    @endslot
                                    @slot('modal_title')
                                        Edit Photo
                                    @endslot
                                    @slot('modal_body')
                                        <div class="col-12 py-3">
                                            @component('admin.components.photo_form')
                                                @slot('data_id')
                                                    {{ $photo->id }}
                                                @endslot
                                                @slot('caption_value')
                                                    {{ $photo->caption }}
                                                @endslot
                                                @slot('details_value')
                                                    {{ $photo->details }}
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
                                        delete_photo_modal
                                    @endslot
                                    @slot('modal_title')
                                        Delete {{ $photo->caption }}
                                    @endslot
                                    @slot('modal_body')
                                        Do you really want to delete {{ $photo->caption }} as a Photo from this App? <br />
                                        Please note that this is not reversible
                                        <p class="text-center">
                                            <button class="btn btn-danger mt-4" data-id="{{ $photo->id }}" id="delete_photo">Delete</button>
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