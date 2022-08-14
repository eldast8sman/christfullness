@extends('layouts.admin.auth')

@section('title')
    CFCI Admin Login
@endsection

@section('content')
<div class="auth-form">
    <h4 class="text-center mb-4">Sign in your account</h4>
    <form class="loginForm">
        @component('admin.components.forms.input')
            @slot('input_label')
                Email
            @endslot
            @slot('input_type')
                email
            @endslot
            @slot('input_name')
                email
            @endslot
            @slot('input_id')
                email
            @endslot
            @slot('input_placeholder')
                Email
            @endslot
            @slot('input_value')
                
            @endslot
        @endcomponent
        @component('admin.components.forms.input')
            @slot('input_label')
                Password
            @endslot
            @slot('input_type')
                password
            @endslot
            @slot('input_name')
                password
            @endslot
            @slot('input_id')
                password
            @endslot
            @slot('input_placeholder')
                Password
            @endslot
            @slot('input_value')
                
            @endslot
        @endcomponent
        <div class="form-row d-flex justify-content-between mt-4 mb-2">
            <div class="form-group">
                <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                </div>
            </div>
            <div class="form-group">
                <a href="forgot-password" href="forgot-password">Forgot Password?</a>
            </div>
        </div>
        @component('admin.components.forms.submit')
            @slot('submit_id')
                sign_in
            @endslot
            @slot('submit_value')
                SignIn
            @endslot
        @endcomponent
    </form>
</div>
@endsection