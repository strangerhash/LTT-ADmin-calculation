@extends('layouts.app.main')
@section('title', 'Buy PIE Pack')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buy PIE Pack</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="gift"></i></span></span>Buy Passive Income Earners (PIE) Units</h4>
                </div>
                <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 col-12">
                        <section class="hk-sec-wrapper">

                            {{-- Include error --}}
                            @include('layouts.partials.error')
                            {{-- /Include error --}}

                            {{-- <h5 class="hk-sec-title card-header text-center">Information</h5>
                            <p class="mb-10 mt-20 lead text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Harum esse in id sequi mollitia deserunt, pariatur earum accusamus, sint iusto omnis magni illum natus nihil non voluptate quisquam ullam necessitatibus!</p>
                            <br/>
                            <br/> --}}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{ route('create-pie') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                  <label for="numberofpieunits">How many PIE Units</label>
                                                  <input type="number" min="1"
                                                    class="form-control" name="numberofpieunits"  onchange="(function(){document.getElementById('ramount').value = (value * {{ $pie_price }});document.getElementById('damount').value = (value * {{ $pie_price }}); })()" id="numberofpieunits" aria-describedby="helpnumberofpieunits" placeholder="Number of PIE Units">
                                                  <small id="helpnumberofpieunits" class="form-text text-muted">Note: You can purchase as many PIE Units as you want.</small>
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
                                                    <small id="passwordHelpBlock" class="form-text text-muted">Enter your password for authorization.</small>
                                                </div>
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                <input type="hidden" name="orderID" value="345">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                                {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['sender' => 2]) }}" > --}}
                                                <input type="hidden" name="custom_metadata[sender]" value="2">  {{-- required --}}
                                                <button class="btn btn-primary" type="submit">Buy PIE Units</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
