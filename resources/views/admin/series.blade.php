@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Message Series
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Message Series
                @endslot
                @slot('page_desc')
                    All the uploaded Message Series 
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Resources</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Media</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Message Series</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Message Series
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_series_modal">Add Series</button>
                            </p>
                            @component('admin.components.tables')
                                @slot('table_id')
                                    series_table
                                @endslot
                                @slot('table_header')
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th></th>
                                    </tr>
                                @endslot
                                @slot('table_body')
                                    @foreach ($series as $ser)
                                        <tr id="series{{ $ser->id }}">
                                            <td><img src="{{ $ser->compressed }}" style="max-width: 300px" /></td>
                                            <td>{{ $ser->title }}</td>
                                            <td>{{ $ser->start_date }}</td>
                                            <td>{{ $ser->end_date }}</td>
                                            <td><a href="{{ env('ADMIN_URL') }}message-series/{{ $ser->slug }}" class="text-primary">More Details</a></td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_series_modal
                                @endslot
                                @slot('modal_title')
                                    Add Series
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.series_form')
                                            @slot('action')
                                                create
                                            @endslot
                                            @slot('title_value')
                                                
                                            @endslot
                                            @slot('description_value')
                                                
                                            @endslot
                                            @slot('start_date_value')
                                                
                                            @endslot
                                            @slot('end_date_value')
                                                
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