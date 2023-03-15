@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Events
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Events
                @endslot
                @slot('page_desc')
                    Upcoming and Future Events
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Events</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Events
                        @endslot
                        @slot('body')
                            <p class="py-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_event_modal">Add Event</button>
                            </p>
                            <div class="row">
                                @foreach ($events as $event)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <a href="{{ env('ADMIN_URL') }}events/{{ $event->slug }}">
                                            @component('admin.components.cards')
                                                @slot('title')

                                                @endslot
                                                @slot('body')
                                                    <div style="
                                                        height: 200px;
                                                        background-image: url({{ $event->compressed }});
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        margin: 0 auto;
                                                    "></div>
                                                    <div class="mt-2" style="height: 80px">
                                                        <h6 class="text-primary">{{ $event->event }}</h6>
                                                        <i>{{ $event->theme }}</i>
                                                    </div>
                                                @endslot
                                            @endcomponent
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{ $events->links(); }}
                                </div>
                            </div>
                            @component('admin.components.long_modal')
                                @slot('modal_id')
                                    add_event_modal
                                @endslot
                                @slot('modal_title')
                                    Add Event
                                @endslot
                                @slot('modal_body')
                                    <div class="col-12 py-3">
                                        @component('admin.components.event_form')
                                            @slot('data_id')

                                            @endslot
                                            @slot('event_value')

                                            @endslot
                                            @slot('theme_value')

                                            @endslot
                                            @slot('start_date_value')

                                            @endslot
                                            @slot('end_date_value')

                                            @endslot
                                            @slot('time_value')

                                            @endslot
                                            @slot('venue_value')

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
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection