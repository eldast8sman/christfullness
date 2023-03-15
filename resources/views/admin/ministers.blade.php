@extends('layouts.admin.other_app')

@section('title')
    CFCI ADMIN|Ministers
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Ministers
                @endslot
                @slot('page_desc')
                    All the Ministers on this Website
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Persons</a></li>
                    <li class="breadcrumb-item active">Ministers</li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Ministers
                        @endslot
                        @slot('body')
                            @component('admin.components.tables')
                                @slot('table_id')
                                    ministers_table
                                @endslot
                                @slot('table_header')
                                    <tr>
                                        <th>Appearance</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th></th>
                                    </tr>
                                @endslot
                                @slot('table_body')
                                    @foreach ($ministers as $minister)
                                        <tr id="minister{{ $minister->id }}">
                                            <td>{{ $minister->appearance }}</td>
                                            <td><img src="{{ $minister->compressed }}" style="max-width:300px"></td>
                                            <td>{{ $minister->title." ".$minister->name }}</td>
                                            <td>{{ $minister->position }}</td>
                                            <td><a href="{{ env('ADMIN_URL') }}ministers/{{ $minister->slug }}" class="text-primary">More Details</a></td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-9 col-sm-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Add a Minister
                        @endslot  
                        @slot('body')
                            @component('admin.components.minister_form')
                                @slot('action')
                                    create
                                @endslot
                                @slot('appearance_options')
                                    @for ($i=1; $i<=$count+1; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                @endslot
                                @slot('title_value')
                                    
                                @endslot
                                @slot('name_value')
                                    
                                @endslot
                                @slot('position_value')
                                    
                                @endslot
                                @slot('phone_value')
                                    
                                @endslot
                                @slot('email_value')
                                    
                                @endslot
                                @slot('about_value')
                                    
                                @endslot
                                @slot('status_options')
                                    <option value="1">Internal</option>
                                    <option value="0">External</option>
                                @endslot
                            @endcomponent
                        @endslot                      
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection