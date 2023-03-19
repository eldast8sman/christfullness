@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN
@endsection

@section('content')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            
            <div class="container-fluid">
                {{-- Home Sliders Section --}}
                <div class="row">
                    <div class="col-12">
                        @component('admin.components.cards')
                            @slot('title')
                                Home Sliders
                            @endslot
                            @slot('body')
                                <p class="py-3">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_homeslider_modal">Add Home Slider</button>
                                </p>
                                <div class="row">
                                    @foreach ($sliders as $slider)
                                        <div class="col-lg-6 col-md-12">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    {{ $slider->caption }}
                                                @endslot
                                                @slot('body')
                                                    <img src="{{ $slider->filename }}" alt="{{ $slider->caption }}" style="width: 100%; height: auto">
                                                    <p class="col-12">
                                                        <table>
                                                            <tr><td><strong>Link: </strong></td><td><a href="{{ $slider->link }}">{{ $slider->link }}</a></td></tr>
                                                            <tr><td><strong>Call To Action: </strong></td><td><center>{{ $slider->call_to_action }}</center></td></tr>
                                                        </table>
                                                    </p>
                                                    <p class="col-12">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_homeslider_modal_{{ $slider->id }}">Edit</button>
                                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_homeslider_modal_{{ $slider->id }}">Delete</button>
                                                    </p>
                                                    @component('admin.components.long_modal')
                                                        @slot('modal_id')
                                                            edit_homeslider_modal_{{ $slider->id }}
                                                        @endslot
                                                        @slot('modal_title')
                                                            Edit Home Slider
                                                        @endslot
                                                        @slot('modal_body')
                                                            <div class="col-12 py-3">
                                                                @component('admin.components.slider_form')
                                                                    @slot('data_id')
                                                                        {{ $slider->id }}
                                                                    @endslot
                                                                    @slot('select_options')
                                                                        @for ($i = 1; $i <= $slider_count; $i++)
                                                                            <option value="{{ $i }}"
                                                                                @if ($i == $slider->position)
                                                                                    {{ " selected" }}
                                                                                @endif
                                                                            >{{ $i }}</option>
                                                                        @endfor
                                                                    @endslot
                                                                    @slot('caption_value')
                                                                        {{ $slider->caption }}
                                                                    @endslot
                                                                    @slot('call_to_action_value')
                                                                        {{ $slider->call_to_action }}
                                                                    @endslot
                                                                    @slot('link_value')
                                                                        {{ $slider->link }}
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
                                                            delete_homeslider_modal_{{ $slider->id }}
                                                        @endslot
                                                        @slot('modal_title')
                                                            Delete {{ $slider->caption }}
                                                        @endslot
                                                        @slot('modal_body')
                                                            Do you really want to delete {{ $slider->caption }} as a Home Slider from this App? <br />
                                                            Please note that this is not reversible
                                                            <p class="text-center">
                                                                <button class="btn btn-danger mt-4 delete_homeslider" data-id="{{ $slider->id }}">Delete</button>
                                                            </p>
                                                        @endslot
                                                    @endcomponent
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach
                                </div>
                                @component('admin.components.long_modal')
                                    @slot('modal_id')
                                        add_homeslider_modal
                                    @endslot
                                    @slot('modal_title')
                                        Add Home Slider
                                    @endslot
                                    @slot('modal_body')
                                        <div class="col-12 py-3">
                                            @component('admin.components.slider_form')
                                                @slot('data_id')
                                                    
                                                @endslot
                                                @slot('select_options')
                                                    @if (empty($slider_count))
                                                       {{ $slider_count = 0 }} 
                                                    @endif
                                                    @for ($i = 1; $i <= $slider_count+1; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                @endslot
                                                @slot('caption_value')
                                                    
                                                @endslot
                                                @slot('call_to_action_value')
                                                    
                                                @endslot
                                                @slot('link_value')
                                                    
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
                {{-- Home Sliders Section --}}

                {{-- Welcome Message Section --}}
                <div class="row">
                    <div class="col-8 col-md-12">
                        @component('admin.components.cards')
                            @slot('title')
                                {{ $welcome->heading }}
                            @endslot
                            @slot('body')
                                <p class="col-12" id="welcomed_content">
                                    {{-- <img src="{{ $welcome->filename }}" alt="{{ $welcome->heading }}"style="width: 400px; max-width:80%; height:auto; float:left; margin-right:15px; margin-bottom:15px"> --}}
                                    {{-- {!! html_entity_decode($welcome->content) !!} --}}
                                </p>
                                <p class="col-12">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_welcome_message_modal">Edit</button>
                                </p>
                                @component('admin.components.long_modal')
                                    @slot('modal_id')
                                        edit_welcome_message_modal
                                    @endslot
                                    @slot('modal_title')
                                        Edit Welcome Message
                                    @endslot
                                    @slot('modal_body')
                                        <div class="col-12 py-3">
                                            @component('admin.components.welcome_message_form')
                                                @slot('heading_value')
                                                    {{ $welcome->heading }}
                                                @endslot
                                                @slot('content_value')
                                                    {{ $welcome->content }}
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
                {{-- Welcome Message Section --}}

                {{-- Home Banner --}}
                <div class="row">
                    <div class="col-8 col-md-12">
                        @component('admin.components.cards')
                            @slot('title')
                                {{ $banner->title }}
                            @endslot
                            @slot('body')
                                <p class="col-12">
                                    {{  $banner->content  }}
                                </p>
                                <p class="col-12">
                                    <b>Call To Action: </b> {{ $banner->call_to_action }}
                                    <br>
                                    <b>Call To Action Link: </b>{{ $banner->link }}
                                </p>
                                <p class="col-12">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_home_banner_modal">Edit</button>
                                </p>
                                @component('admin.components.long_modal')
                                    @slot('modal_id')
                                        edit_home_banner_modal
                                    @endslot
                                    @slot('modal_title')
                                        Edit Home Banner
                                    @endslot
                                    @slot('modal_body')
                                        <div class="col-12 py-3">
                                            @component('admin.components.home_banner_form')
                                                @slot('title_value')
                                                    {{ $banner->title }}
                                                @endslot
                                                @slot('content_value')
                                                    {{ $banner->content }}
                                                @endslot
                                                @slot('action_value')
                                                    {{ $banner->call_to_action }}
                                                @endslot
                                                @slot('link_value')
                                                    {{ $banner->link }}
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
                {{-- Home Banner --}}

                {{-- Quotes --}}
                <div class="row">
                    <div class="col-12">
                        @component('admin.components.cards')
                            @slot('title')
                                Quotes
                            @endslot
                            @slot('body')
                                <p class="py-3">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_quote_modal">Add Quote</button>
                                </p>
                                <div class="row">
                                    @foreach ($quotes as $quote)
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            @component('admin.components.cards')
                                                @slot('title')
                                                    
                                                @endslot
                                                @slot('body')
                                                    <p class="col-12">
                                                        {{ $quote->quote; }}
                                                    </p>
                                                    <p class="col-12">
                                                        <b>Author: </b>{{ $quote->author }} <span><img src="{{ $quote->compressed }}" alt="{{ $quote->author }}"></span>
                                                        <br>
                                                        <b>Author Title: </b>{{ $quote->author_title }}
                                                    </p>
                                                    <p class="col-12">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit_quote_modal_{{ $quote->id }}">Edit</button>
                                                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete_quote_modal_{{ $quote->id }}">Delete</button>
                                                    </p>
                                                    @component('admin.components.long_modal')
                                                        @slot('modal_id')
                                                            edit_quote_modal_{{ $quote->id }}
                                                        @endslot
                                                        @slot('modal_title')
                                                            Edit Quote
                                                        @endslot
                                                        @slot('modal_body')
                                                            <div class="col-12 py-3">
                                                                @component('admin.components.quote_form')
                                                                    @slot('data_id')
                                                                        {{ $quote->id }}
                                                                    @endslot
                                                                    @slot('quote_value')
                                                                        {{ $quote->quote }}
                                                                    @endslot
                                                                    @slot('author_value')
                                                                        {{ $quote->author }}
                                                                    @endslot
                                                                    @slot('title_value')
                                                                        {{ $quote->author_title }}
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

                                            @component('admin.components.small_modal')
                                                @slot('modal_id')
                                                    delete_quote_modal_{{ $quote->id }}
                                                @endslot
                                                @slot('modal_title')
                                                    Delete Quote
                                                @endslot
                                                @slot('modal_body')
                                                    Do you really want to delete this Quote from this App? <br />
                                                    Please note that this is not reversible
                                                    <p class="text-center">
                                                        <button class="btn btn-danger mt-4 delete_quote" data-id="{{ $quote->id }}">Delete</button>
                                                    </p>
                                                @endslot
                                            @endcomponent
                                        </div>
                                    @endforeach
                                </div>
                                @component('admin.components.long_modal')
                                    @slot('modal_id')
                                        add_quote_modal
                                    @endslot
                                    @slot('modal_title')
                                        Add Quote
                                    @endslot
                                    @slot('modal_body')
                                        <div class="col-12 py-3">
                                            @component('admin.components.quote_form')
                                                @slot('data_id')
                                                    
                                                @endslot
                                                @slot('quote_value')
                                                    
                                                @endslot
                                                @slot('author_value')
                                                    
                                                @endslot
                                                @slot('title_value')
                                                    
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
                {{-- Quotes --}}
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection