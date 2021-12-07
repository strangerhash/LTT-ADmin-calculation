@extends('layouts.website')
@section('title', 'Reset Password')

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
                                    src="{{ asset('/assets/dist/img/iscube-logo.png')}}"
                                    alt="ISCUBE logo"
                                />
                            </a>

                            <p class="text-center mb-30">
                                Provide the following information to change your password.
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

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus  placeholder="E-mail">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="mail"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="input-group">

                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

                                        <div class="input-group-append">
                                            <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                        </div>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-success btn-block">Change password</button>
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
