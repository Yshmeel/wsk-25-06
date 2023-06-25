@extends('layouts.guest')
@section('content')
    <section class="login">
        <div class="login-block">
            <div class="login-header">
                <b>Login</b>
                <span>Input your login and password to be proceed</span>
            </div>

            @if(\Illuminate\Support\Facades\Session::has("error"))
                <div class="login-error">
                    <span>{{ \Illuminate\Support\Facades\Session::get("error")  }}</span>
                </div>
            @endif

            <div class="login-form">
                <form action="/login" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="input"/>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="input"/>
                    </div>

                    <div class="form-button">
                        <button type="submit" class="btn btn-success">
                            Enter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
