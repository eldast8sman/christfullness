@extends('layouts.admin.app')

@section('title')
    CFCI ADMIN|{{ $minister->name }}
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Minister
                @endslot    
                @slot('page_desc')
                    {{ $minister->name }}
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Persons</a></li>
                    <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}/dashboard/ministers">Ministers</a></li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            {{ $minister->name }}
                        @endslot
                        @slot('body')
                            <div class="row">
                                <div class="col-lg-6 col-md-9 col-sm-12 mx-auto my-3">
                                    <img src="{{ $minister->filepath }}" style="width: 600px; max-width: 90%; height:auto; margin: 0 auto" />
                                    <h4><{{ $minister->position }}</h4>
                                </div>
                                <div class="col-lg-9 col-md-12 mx-auto text-justify text-dark">
                                    <p>{{ $minister->about }}</p>
                                    <p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit_minister_modal">Edit</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_minister_modal">Delete</button>

                                        @component('admin.components.long_modal')
                                            @slot('modal_id')
                                                edit_minister_modal
                                            @endslot
                                            @slot('modal_title')
                                                Edit Minister
                                            @endslot
                                            @slot('modal_body')
                                                <div class="col-12 py-3">
                                                    <input type="hidden" id="minister_id" value="{{ $minister->id }}" />
                                                    @component('admin.components.minister_form')
                                                        @slot('action')
                                                            update
                                                        @endslot
                                                        @slot('appearance_options')
                                                            @for($i=1; $i<=$count; $i++)
                                                                <option value="{{ $i }}"
                                                                    @if($i == $minister->appearance)
                                                                        {{ " selected" }}
                                                                    @endif
                                                                >{{ $i }}</option>
                                                            @endfor
                                                        @endslot
                                                        @slot('name_value')
                                                            {{ $minister->name }}
                                                        @endslot
                                                        @slot('position_value')
                                                            {{ $minister->position }}
                                                        @endslot
                                                        @slot('phone_value')
                                                            {{ $minister->phone }}
                                                        @endslot
                                                        @slot('email_value')
                                                            {{ $minister->email }}
                                                        @endslot
                                                        @slot('about_value')
                                                            {{ $minister->about }}
                                                        @endslot
                                                        @slot('status_options')
                                                            <option value="1"
                                                                @if($minister->status == "1")
                                                                    {{ " selected" }}
                                                                @endif
                                                            >Internal</option>
                                                            <option value="0"
                                                            @if($minister->status == "0")
                                                                {{ " selected" }}
                                                            @endif
                                                            >External</option>
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
                                                delete_minister_modal
                                            @endslot
                                            @slot('modal_title')
                                                Delete {{ $minister->name }}
                                            @endslot
                                            @slot('modal_body')
                                                Do you really want to delete {{ $minister->name }} as a Minister from this App? <br />
                                                Please note that this is not reversible
                                                <p class="text-center">
                                                    <button class="btn btn-danger mt-4" data-id="{{ $minister->id }}" id="delete_minister">Delete</button>
                                                </p>
                                            @endslot
                                        @endcomponent
                                    </p>
                                </div>
                            </div>   
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection