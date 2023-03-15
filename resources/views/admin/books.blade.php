@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Books
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Books
                @endslot
                @slot('page_desc')
                    All Published Books
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Books</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Books
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_book_modal">Add Book</button>
                            </p>
                            <div class="row">
                                @foreach ($books as $book)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                        <a href="{{ env('ADMIN_URL') }}books/{{ $book->slug }}">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    
                                                @endslot
                                                @slot('body')
                                                    <div style="
                                                        height: 200px; 
                                                        background-image: url({{ $book->compressed_image }});
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        margin: 0 auto;
                                                    "></div>
                                                    <div class="mt-2" style="height: 80px">
                                                        <h6 class="text-primary">{{ $book->title }}</h6>
                                                        <i>{{ $book->author->title.' '.$book->author->name }}</i>
                                                    </div>
                                                @endslot
                                            @endcomponent
                                        </a>
                                    </div>
                                @endforeach                            
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{ $books->links(); }}
                                </div>
                            </div>
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_book_modal
                                @endslot
                                @slot('modal_title')
                                    Add Book
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.book_form')
                                            @slot('data_id')

                                            @endslot
                                            @slot('title_value')

                                            @endslot
                                            @slot('summary_value')
                                                
                                            @endslot
                                            @slot('author_options')
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