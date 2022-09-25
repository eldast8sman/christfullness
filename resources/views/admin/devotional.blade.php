@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $devotional->title }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Devotionals
                @endslot
                @slot('page_desc')
                    {{ date('l, jS F, Y', strtotime($devotional->devotional_date)) }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL')."devotionals" }}">Devotionals</a></li>
                    <li class="breadcrumb-item active"><a href="javascript">{{ date('l, jS F, Y', strtotime($devotional->devotional_date)) }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ date('l, jS F, Y', strtotime($devotional->devotional_date)) }}
                        @endslot
                        @slot('body')
                            <div class="col-12 text-dark">
                                <h4>{{ $devotional->topic }}</h4>
                                <h5>{{ $devotional->bible_text }}</h5>
                                <p class="text-center">
                                    <strong>Memory Verse</strong>
                                    <br />
                                    <i>"{{ $devotional->memory_verse }}"</i>
                                    <br />
                                    {{ $devotional->memory_verse_text }}
                                </p>
                                <p>
                                    <blockquote>{!! nl2br($devotional->devotional) !!}</blockquote>
                                </p>
                                <p>
                                    <strong>Further Reading</strong><br />
                                    {!! nl2br($devotional->further_reading) !!}
                                </p>
                                <p>
                                    <strong>Prayers</strong><br />
                                    {!! nl2br($devotional->prayers) !!}
                                </p>
                                <p>
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_devotional_modal">Edit</button>
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_devotional_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_devotional_modal
                                        @endslot
                                        @slot('modal_title')
                                            Edit Devotional
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.devotional_form')
                                                @slot('data_id')
                                                    {{ $devotional->id }}
                                                @endslot
                                                @slot('devotional_date_value')
                                                    {{ $devotional->devotional_date }}
                                                @endslot
                                                @slot('minister_options')
                                                    @foreach ($ministers as $minister)
                                                        <option value="{{ $minister->id }}"
                                                            @if ($minister->id == $devotional->minister_id)
                                                                {{ " selected" }}
                                                            @endif    
                                                        >{{ $minister->name.'('.$minister->title.')' }}</option>
                                                    @endforeach
                                                @endslot
                                                @slot('topic_value')
                                                    {{ $devotional->topic }}
                                                @endslot
                                                @slot('bible_text_value')
                                                    {{ $devotional->bible_text }}
                                                @endslot
                                                @slot('memory_verse_text_value')
                                                    {{ $devotional->memory_verse_text }}
                                                @endslot
                                                @slot('memory_verse_value')
                                                    {{ $devotional->memory_verse }}
                                                @endslot
                                                @slot('devotional_value')
                                                    {{ $devotional->devotional }}
                                                @endslot
                                                @slot('further_reading_value')
                                                    {{ $devotional->further_reading }}
                                                @endslot
                                                @slot('prayers_value')
                                                    {{ $devotional->prayers }}
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
                                            delete_devotional_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $devotional->topic }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $devotional->topic }} as a Devotional from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $devotional->id }}" id="delete_devotional">Delete</button>
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