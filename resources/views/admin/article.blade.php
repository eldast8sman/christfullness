@extends('layouts.admin.backup_app')

@section('title')
    CFCI ADMIN|{{ $article->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Articles
                @endslot
                @slot('page_desc')
                    {{ $article->title }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}articles">Articles</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $article->title }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $article->title }}
                        @endslot
                        @slot('body')
                            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $article->image_path }}" alt="{{ $article->title }}" style="
                                    width: 600px;
                                    max-width: 90%;
                                    height: auto;
                                    margin: 0 auto;
                                ">
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>
                                    <strong>Publication Date: </strong>{{ date('l, jS F, Y', strtotime($article->published)) }}
                                </p>
                                <p>{!! html_entity_decode($article->article) !!}</p>
                                <p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_article_modal">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_article_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_article_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Article
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.article_form')
                                                    @slot('data_id')
                                                        {{ $article->id }}
                                                    @endslot
                                                    @slot('title_value')
                                                        {{ $article->title }}
                                                    @endslot
                                                    @slot('author_value')
                                                        {{ $article->author }}
                                                    @endslot
                                                    @slot('article_value')
                                                        {!! html_entity_decode($article->article) !!}
                                                    @endslot
                                                    @slot('published_value')
                                                        {{ $article->published }}
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
                                            delete_article_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $article->title }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $article->title }} as an Article from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $article->id }}" id="delete_article">Delete</button>
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