@extends('layouts.website')
@section('title', 'Registration')
@section('content')
<div class="hk-wrapper">
    <!-- Main Content -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
                <header class="d-flex justify-content-end align-items-center">
                    <div class="btn-group btn-group-sm">
                        <a href="https://iscubenetworks.com/" class="btn btn-outline-secondary">Homepage</a>
                    </div>
                </header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 pa-0">
                            <div class="auth-form-wrap pt-xl-0 pt-70">
                                <div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
                                    <a class="auth-brand text-center d-block mb-10" href="https://iscubenetworks.com/">
                                        <img class="brand-img" src="/assets/dist/img/iscube-logo.png" alt="ISCUBE logo" />
                                    </a>
                                    <h1 class="display-4 mb-10 text-center">Sign up for free</h1>
                                    <!--- passive income, shopping, cashback, recharge & earn and more-->
                                    <p class="mb-20 text-center">One account. All of ISCUBE services accessible.</p>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('register') }}" autocomplete="off" method="post" accept-charset="utf-8">
                                        @csrf
                                            <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <div class="input-group">
                                                    <input class="form-control" onchange="confirmUniqueUsername()" placeholder="Username" type="text" name="username" value="{{ old('username') }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="user"></i></span></span>
                                                    </div>
                                                </div>
                                                <small class="form-text font-weight-bold" id="unique_username"></small>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <div class="input-group">
                                                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" value="{{ old('phone') }}" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="phone"></i></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" onchange="confirmUniqueEmail()" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="mail"></i></span></span>
                                                </div>
                                            </div>
                                            <small class="form-text font-weight-bold" id="unique_email"></small>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" onchange="fetchReferralInfo()" placeholder="Referrer username" type="text" name="referrer" value="@if(!empty(old('referrer'))){{old('referrer')}}@elseif(!empty($username)){{ $username }}@endif" @isset($username) readonly @endisset required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="user"></i></span></span>
                                                </div>
                                            </div>
                                            <small class="form-text font-weight-bold" id="referrer_info"></small>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Password" type="password" name="password" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="feather-icon"><i data-feather="lock"></i></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-25">
                                            <label class="font-14">By clicking on Register, you agree to our <a href="{{ url('/terms-and-conditions') }}">Terms</a> and that you have read our <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>.</label>
                                        </div>
                                        <button class="btn btn-success btn-block" id="submit" type="submit">Register</button>
                                        <p class="text-center">Already have an account? <a href="{{ url('/auth/login') }}">Log In</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Main Content -->
    <!-- /Main Content -->
</div>
@endsection

@section('scripts')
    <script>
        function fetchReferralInfo() {
            referral_username = $('input[name="referrer"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/fetch-user-info") }}',
                data: { referrer: referral_username }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", true);
                $('#referrer_info').html("<b class='text-danger'>User not found</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", false);
                data = JSON.parse(msg)
                $('#referrer_info').html("<b class='text-success'>You were referred by: </b><b>" + data.fname + " " + data.lname + "</b>");
            });
        }

        function confirmUniqueUsername() {
            username = $('input[name="username"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/is-username-unique") }}',
                data: { username: username }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", false);
                $('#unique_username').html("<b class='text-success'>Username available!</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", true);
                $('#unique_username').html("<b class='text-danger'>Username already taken!</b>");
            });
        }

        function confirmUniqueEmail() {
            email = $('input[name="email"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '{{ url("/is-email-unique") }}',
                data: { email: email }
            })
            .fail(function (error) {
                $("#submit").attr("disabled", false);
                $('#unique_email').html("<b class='text-success'>E-mail available!</b>");
            })
            .done(function( msg ) {
                $("#submit").attr("disabled", true);
                $('#unique_email').html("<b class='text-danger'>E-mail already used!</b>");
            });
        }
    </script>
@endsection
