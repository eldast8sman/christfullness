@extends('layouts.admin.app');

@section('title')
    CFCI ADMIN||Admins
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            @component('admin.components.breadcrumbs')
                @slot('page_header')
                    Website Admins
                @endslot
                @slot('page_desc')
                    All the Website's Administrators
                @endslot
                @slot('other_links')
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Persons</a></li>
                    <li class="breadcrumb-item active">Admins</li>
                @endslot
            @endcomponent
            <div class="row">
                <div class="col-12">
                    @component('admin.components.cards')
                        @slot('title')
                            Admins
                        @endslot
                        @slot('body')
                            @component('admin.components.tables')
                                @slot('table_id')
                                    admin_table
                                @endslot
                                @slot('table_header')
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Created</th>
                                        <th></th>
                                        <th>Delete</th>
                                    </tr>
                                @endslot
                                @slot('table_body')
                                    @foreach($users as $user)
                                        <tr id="admin{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td><a href="admin/{{ $user->id }}" class="btn btn-primary" id="edit_admin">Edit</a></a></td>
                                            <td><button class="del_admin btn btn-danger" id="del_admin" data-id="{{ $user->id }}">Delete</button></td>
                                        </tr>
                                    @endforeach
                                @endslot
                            @endcomponent
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-9">
                    @component('admin.components.cards')
                        @slot('title')
                            Add an Admin
                        @endslot
                        @slot('body')
                            @component('admin.components.admin_form')
                                @slot('action')
                                    create
                                @endslot
                            @endcomponent
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection