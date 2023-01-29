@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|Magazines
@endsection

@section('content')
    <div class="content">
        <div class="content-body">
            @component('admin.components.breadcrumbs')
            @slot('page_header')
                Magazines
            @endslot
            @slot('page_desc')
                All Published Magazines
            @endslot
            @slot('other_links')
                <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Magazines</a></li>
            @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Magazines
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_magazine_modal">Add Magazine</button>
                            </p>
                            <div class="row">
                                @foreach ($magazines as $magazine)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                        <a href="{{ env('ADMIN_URL') }}magazines/{{ $magazine->slug }}">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    
                                                @endslot
                                                @slot('body')
                                                    <div style="
                                                        height: 200px; 
                                                        background-image: url({{ $magazine->compressed }});
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        margin: 0 auto;
                                                    "></div>
                                                    <div class="mt-2" style="height: 80px">
                                                        <h6 class="text-primary">{{ $magazine->title }}</h6>
                                                        <i>{{ date('l jS \of F Y', strtotime($magazine->publication_date)) }}</i>
                                                    </div>
                                                    
                                                @endslot
                                            @endcomponent
                                        </a>
                                    </div>
                                @endforeach                            
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{ $magazines->links(); }}
                                </div>
                            </div>
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_magazine_modal
                                @endslot
                                @slot('modal_title')
                                    Add Magazine
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.magazine_form')
                                            @slot('data_id')
                                                
                                            @endslot
                                            @slot('title_value')
                                                
                                            @endslot
                                            @slot('publication_date')
                                                
                                            @endslot
                                            @slot('summary_value')
                                                
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