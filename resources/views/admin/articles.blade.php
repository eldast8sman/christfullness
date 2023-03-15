@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Articles
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Articles
                @endslot
                @slot('page_desc')
                    All Uploaded Articles
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Articles</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Articles
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add_article_modal">Add Article</button>
                            </p>
                            <div class="row">
                                @foreach ($articles as $article)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <a href="{{ env('ADMIN_URL') }}articles/{{ $article->slug }}">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    
                                                @endslot
                                                @slot('body')
                                                    <div style="
                                                        height: 200px;
                                                        background-image: url({{ $article->compressed_image }});
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        margin: 0 auto;
                                                    ">
                                                    </div>
                                                    <div class="mt-2" style="height: 80px">
                                                        <h5 class="text-primary">{{ $article->title }}</h5>
                                                    </div>
                                                @endslot
                                            @endcomponent
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endslot
                    @endcomponent
                </div>
                <div class="row">
                    <div class="col-12">{{ $articles->links(); }}</div>
                </div>
                @component('admin.components.long_modal')
                    @slot('modal_id')
                        add_article_modal
                    @endslot
                    @slot('modal_title')
                        Add Article
                    @endslot
                    @slot('modal_body')
                        <div class="col-12 py-3">
                            @component('admin.components.article_form')
                                @slot('data_id')
                                    
                                @endslot
                                @slot('title_value')
                                    
                                @endslot
                                @slot('author_value')
                                    
                                @endslot
                                @slot('article_value')
                                    
                                @endslot
                                @slot('published_value')
                                    {{ date('Y-m-d') }}
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
    </div>
@endsection