@extends('layouts.app.main')
@section('title', 'Short Term Thrift Unit(s)')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buy Short Term Thrift Unit(s)</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="gift"></i></span></span>Buy Short Term Thrift Unit(s)</h4>
                </div>
                <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 col-12">
                        <section class="hk-sec-wrapper">

                            {{-- Include error --}}
                            @include('layouts.partials.error')
                            {{-- /Include error --}}

                            @if (Auth::user()->is_upgraded == 0)
                                <h5 class="hk-sec-title card-header text-center">Information</h5>
                                <p class="mb-10 mt-20 lead text-muted">You need to UPGRADE your account before you can be able to purchase Short Term Thrift Unit(s).</p>
                                <p class="mb-40 lead text-muted">Please click on the button below to upgrade.</p>
                                <br/>
                                <br/>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <a class="btn btn-primary" href="{{ route('user_upgrade') }}" role="button">Upgrade</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="{{ route('matrix-thrift-add') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                      <label for="numberofmtpacks">How many Short Term Thrift Unit(s)</label>
                                                      <input type="number" min="1"
                                                            class="form-control"
                                                            onchange="(function(){document.getElementById('ramount').value = (value * {{ $mt_price }});document.getElementById('damount').value = (value * {{ $mt_price }}); })()"
                                                            name="quantity" id="numberofmtpacks" aria-describedby="helpnoofmtpacks" placeholder="Number of MT packs">
                                                      <small id="helpnoofmtpacks" class="form-text text-muted">Note: You can only purchase 2 Short Term Thrift Units pack per day</small>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="amount">Amount</label>
                                                      <input type="number" readonly
                                                        class="form-control" name="" value="0" id="damount" aria-describedby="helpamount" placeholder="0">
                                                        <input type="hidden" name="amount" id="ramount" value="0">
                                                      <small id="helpamount" class="form-text text-muted">Total amount to be paid</small>
                                                    </div>

                                                    <div class="form-group">
                                                      <label for="paymentmethod">Payment Method</label>
                                                      <select class="form-control" name="paymentmethod" id="paymentmethod">
                                                        <option value="">Choose One</option>
                                                        <option value="11">My Purse - PIE Account ({{'₦'.Auth::user()->wallet->pie}})</option>
                                                        <option value="12">My Purse - Matrix Account ({{'₦'.Auth::user()->wallet->balance}})</option>
                                                        <option value="2">Online Payment</option>
                                                      </select>
                                                      <small id="helppaymentmethod" class="form-text text-muted">How do you want to pay?</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userpassword">Password</label>
                                                        <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="xxxxxxxx" aria-describedby="passwordHelpBlock">
                                                        <small id="passwordHelpBlock" class="form-text text-muted">Enter password for authorization.</small>
                                                    </div>
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                    <input type="hidden" name="orderID" value="345">
                                                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                                    {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['sender' => 3]) }}" > --}}
                                                    <input type="hidden" name="custom_metadata[sender]" value="3">  {{-- required --}}
                                                    <button class="btn btn-primary" type="submit">Buy Short Term Thrift Unit(s)</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
