@extends('layouts.admin.backup_app');

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
                    <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/dashboard/admins">Admins</a></li>
                    <li class="breadcrumb-item active">Edit Admin</li>
                @endslot
            @endcomponent

            <div class="row">
                <div class="col-lg-6 col-md-9">
                    <input type="hidden" id="admin_id" value="{{ $user['id'] }}">
                    @component('admin.components.cards')
                        @slot('title')
                            Edit an Admin
                        @endslot
                        @slot('body')
                            @component('admin.components.admin_form')
                                @slot('action')
                                    update
                                @endslot
                               
                            @endcomponent
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection