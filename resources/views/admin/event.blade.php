@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $event->event }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Events
                @endslot
                @slot('page_desc')
                    {{ $event->event }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="{{ env('ADMIN_URL') }}events">Events</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $event->event }}</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $event->event }}
                        @endslot
                        @slot('body')
                            <div class="col-lg-6 col-m-9 col-sm-12 mx-auto my-3">
                                <img src="{{ $event->filename }}" alt="{{ $event->event }}" style="
                                    width: 600px;
                                    max-width: 90%;
                                    height: auto;
                                    margin: 0 auto;
                                ">
                            </div>
                            <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                <p>
                                    <b>Theme: </b><br />{{ $event->theme }}
                                </p>
                                <p>
                                    Venue:
                                    <br>
                                    {!! nl2br($event->venue) !!}
                                </p>
                                <p>
                                    <b>Date: </b>
                                    <br>
                                    <span>{{ $event->start_date }}</span>
                                    @if (!empty($event->end_date))
                                        <span> - {{ $event->end_date }}</span>
                                    @endif
                                </p>
                                <p>
                                    <b>Time:</b>
                                    <br>
                                    {!! nl2br($event->timing) !!}
                                </p>
                                <p>{!! nl2br($event->details) !!}</p>
                                <p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_event_modal">Edit</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_event_modal">Delete</button>

                                    @component('admin.components.long_modal')
                                        @slot('modal_id')
                                            edit_event_modal
                                        @endslot
                                        @slot('modal_title')
                                            Update Event
                                        @endslot
                                        @slot('modal_body')
                                            <div class="col-12 py-3">
                                                @component('admin.components.event_form')
                                                    @slot('data_id')
                                                        {{ $event->id }}
                                                    @endslot
                                                    @slot('event_value')
                                                        {{ $event->event }}
                                                    @endslot
                                                    @slot('theme_value')
                                                        {{ $event->theme }}
                                                    @endslot
                                                    @slot('start_date_value')
                                                        {{ $event->start_date }}
                                                    @endslot
                                                    @slot('end_date_value')
                                                        {{ $event->end_date }}
                                                    @endslot
                                                    @slot('time_value')
                                                        {{ $event->timing }}
                                                    @endslot
                                                    @slot('venue_value')
                                                        {{ $event->venue }}
                                                    @endslot
                                                    @slot('details_value')
                                                        {{ $event->details }}
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
                                            delete_event_modal
                                        @endslot
                                        @slot('modal_title')
                                            Delete {{ $event->event }}
                                        @endslot
                                        @slot('modal_body')
                                            Do you really want to delete {{ $event->event }} as an Event from this App? <br />
                                            Please note that this is not reversible
                                            <p class="text-center">
                                                <button class="btn btn-danger mt-4" data-id="{{ $event->id }}" id="delete_event">Delete</button>
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