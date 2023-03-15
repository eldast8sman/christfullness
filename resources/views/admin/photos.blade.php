@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Photos
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Photos
                @endslot
                @slot('page_desc')
                    All Uploaded Photos
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Photos</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12 mb-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_photo_modal">Add Photo</button>
                </div>
                @foreach ($photos as $photo)
                    <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
                        <a href="{{ env('ADMIN_URL') }}photos/{{ $photo->slug }}">
                            @component('admin.components.cards')
                                @slot('title')
                                    
                                @endslot
                                @slot('body')
                                    <div style="
                                        height: 200px;
                                        background-image: url({{ $photo->compressed }});
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        background-position: center center;
                                        margin: 0 auto
                                    "></div>
                                    <div class="mt-2" style="height: 50px">
                                        <h6 class="text-primary">{{ $photo->caption }}</h6>
                                    </div>
                                @endslot
                            @endcomponent
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $photos->links() }}
                </div>
            </div>
            @component('admin.components.long_modal')
                @slot('modal_id')
                    add_photo_modal
                @endslot
                @slot('modal_title')
                    Add Photo
                @endslot
                @slot('modal_body')
                    <div class="col-12 py-3">
                        @component('admin.components.photo_form')
                            @slot('data_id')
                                
                            @endslot
                            @slot('caption_value')
                                
                            @endslot
                            @slot('details_value')
                                
                            @endslot
                        @endcomponent
                    </div>
                @endslot
                @slot('modal_footer')
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection