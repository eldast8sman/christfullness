@extends('layouts.admin.auth')

@section('title')
    CFCI Admin Login
@endsection

@section('content')
<div class="auth-form">
    <h4 class="text-center mb-4">Sign in your account</h4>
    <form class="loginForm">
        <div class="form-group">
            <label><strong>Email</strong></label>
            <input type="email" class="form-control" id="email" value="hello@example.com">
        </div>
        <div class="form-group">
            <label><strong>Password</strong></label>
            <input type="password" class="form-control" id="password" value="Password">
        </div>
        <div class="form-row d-flex justify-content-between mt-4 mb-2">
            <div class="form-group">
                <div class="form-check ml-2">
                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                </div>
            </div>
            <div class="form-group">
                <a href="forgot-password">Forgot Password?</a>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Sign me in</button>
        </div>
    </form>
    <div class="new-account mt-3">
        <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p>
    </div>
</div>
@endsection