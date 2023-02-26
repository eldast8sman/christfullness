@extends('layouts.admin.backup_app')

@section('title')
    CFCI ADMIN|{{ $book->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Books
                @endslot
                @slot('page_desc')
                    {{ $book->title }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Publications</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}books">Books</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $book->title }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $book->title }}
                        @endslot
                        @slot('body')
                            <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $book->image_path }}" alt="{{ $book->title }}" style="
                                    width: 600px;
                                    max-width: 90%;
                                    height: auto;
                                    margin: 0 auto;
                                ">
                                <p class="mt-3">
                                    <a href="{{ $book->book_path }}" download="{{ $book->slug }}" class="text-primary">Download</a>
                                </p>
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p><strong>Downloads: </strong> {{ $book->downloads }}</p>
                                <p>{{ $book->summary }}</p>
                                <p>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_book_modal">Edit</button>
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_book_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_book_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Book
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.book_form')
                                                    @slot('data_id')
                                                        {{ $book->id }}
                                                    @endslot
                                                    @slot('title_value')
                                                        {{ $book->title }}
                                                    @endslot
                                                    @slot('summary_value')
                                                        {{ $book->summary }}
                                                    @endslot
                                                    @slot('author_options')
                                                        @foreach ($ministers as $minister)
                                                            <option value="{{ $minister->id }}"
                                                                @if($minister->id == $book->minister_id)
                                                                    {{ " selected" }}
                                                                @endif
                                                            >{{ $minister->name."(".$minister->title.")" }}</option>
                                                        @endforeach
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
                                            delete_book_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $book->tite }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $book->title }} as a Book from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $book->id }}" id="delete_book">Delete</button>
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