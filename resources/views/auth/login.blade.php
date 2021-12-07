@extends('layouts.website')
@section('title', 'Login')
@section('content')
<div class="hk-wrapper">
    <!-- Main Content -->
    <div class="hk-pg-wrapper hk-auth-wrapper">
        <header class="d-flex justify-content-end align-items-center">
            <div class="btn-group btn-group-sm">
                <a
                    href="https://iscubecommunity.com/"
                    class="btn btn-outline-secondary"
                    >Homepage</a
                >
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 pa-0">
                    <div class="auth-form-wrap pt-xl-0 pt-70">
                        <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                            <a
                                class="auth-brand text-center d-block mb-20"
                                href="https://iscubenetworks.com/"
                            >
                                <img
                                    class="brand-img"
                                    src="../assets/dist/img/iscube-logo.png"
                                    alt="ISCUBE logo"
                                />
                            </a>

                            <h1 class="display-4 text-center mb-10">
                                Welcome Back
                            </h1>
                            <p class="text-center mb-30">
                                Sign in to your account and enjoy unlimited
                                perks.
                            </p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" id="login-form" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <div class="input-group">

                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required  autofocus  placeholder="Username" />

                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="mail"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password" />

                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                        </div>

                                    </div>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-success btn-block g-recaptcha">Login</button>
                                <p class="font-14 text-center mt-15">
                                    Having trouble logging in?
                                    <a href="{{ route('password.request') }}">Recover Password</a>
                                </p>
                                <p class="text-center">
                                    Don't have an account yet?
                                    <a href="{{ url('/auth/register') }}">Register</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Content -->
</div>
@endsection
