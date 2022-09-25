@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|Devotionals
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Devotionals
                @endslot
                @slot('page_desc')
                    All the Devotionals on this Website
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Devotionals</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Devotionals
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_devotional_modal">Add Devotional</button>
                            </p>
                            @component('admin.components.tables')
                                @slot('table_id')
                                    devotionals_table
                                @endslot
                                @slot('table_header')
                                    <tr>
                                        <th>Devotional Date</th>
                                        <th>Devotional Topic</th>
                                        <th>Minister</th>
                                        <th></th>
                                    </tr>
                                @endslot
                                @slot('table_body')
                                    @foreach ($devotionals as $devotional)
                                        <tr>
                                            <td>{{ date('l, jS F, Y', strtotime($devotional->devotional_date)) }}</td>
                                            <td>{{ $devotional->topic }}</td>
                                            <td>{{ $devotional->minister->title.' '.$devotional->minister->name }}</td>
                                            <td><a href="{{ env('ADMIN_URL') }}devotionals/{{ $devotional->slug }}">More Details</a></td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                            <div class="row">
                                <div class="col-12">
                                    {{ $devotionals->links(); }}
                                </div>
                            </div>
                        @endslot
                    @endcomponent

                    @component('admin.components.long_modal')
                        @slot('modal_id')
                            add_devotional_modal
                        @endslot
                        @slot('modal_title')
                            Add Devotional
                        @endslot
                        @slot('modal_body')
                            <div class="col-12 py-3">
                                @component('admin.components.devotional_form')
                                    @slot('data_id')
                                        
                                    @endslot
                                    @slot('devotional_date_value')
                                        
                                    @endslot
                                    @slot('minister_options')
                                        @foreach ($ministers as $minister)
                                            <option value="{{ $minister->id }}">{{ $minister->name.'('.$minister->title.')' }}</option>
                                        @endforeach
                                    @endslot
                                    @slot('topic_value')
                                        
                                    @endslot
                                    @slot('bible_text_value')
                                        
                                    @endslot
                                    @slot('memory_verse_text_value')
                                        
                                    @endslot
                                    @slot('memory_verse_value')
                                        
                                    @endslot
                                    @slot('devotional_value')
                                        
                                    @endslot
                                    @slot('further_reading_value')
                                        
                                    @endslot
                                    @slot('prayers_value')
                                        
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
    </div>
@endsection