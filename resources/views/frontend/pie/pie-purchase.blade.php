@extends('layouts.app.main')
@section('title', 'Purchase LTT units')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Long Term Thrift</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase units</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="gift"></i></span></span>Purchase LTT unit(s)</h4>
                </div>
                <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-7 col-12">
                        <section class="hk-sec-wrapper">

                            {{-- Include error --}}
                            @include('layouts.partials.error')
                            {{-- /Include error --}}

                            <div class="row">
                                <div class="col-sm">
                                    <div class="row">
                                        <div class="col-12">
                                            <form id="purchase-form" action="{{ route('pie-purchase') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                  <label for="numberofpieunits">How many units</label>
                                                  <input type="number" min="1" value="1"
                                                      onchange="changeAmount()"
                                                    class="form-control" name="numberofpieunits"
                                                    id="numberofpieunits" aria-describedby="helpnumberofpieunits" placeholder="Number of LTT Units">
                                                  <small id="helpnumberofpieunits" class="form-text text-muted">Note: You cannot purchase more than 200 LTT units.</small>
                                                </div>
                                                <div class="form-group">
                                                  <label for="paymentmethod">Payment Method</label>
                                                  <select class="form-control" name="paymentmethod" id="paymentmethod">
                                                    <option value="11" selected>Total Wallet Balance ({{'₦'.Auth::user()->total_wallet_balance}})</option>
                                                  </select>
                                                  <small id="helppaymentmethod" class="form-text text-muted">How do you want to pay?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" readonly
                                                        class="form-control" name="" value="5000" id="damount" aria-describedby="helpamount" placeholder="0">
                                                        <input type="hidden" name="amount" id="ramount" value="0">
                                                    <small id="helpamount" class="form-text text-muted">Total amount to be paid</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="xxxxxxxx" aria-describedby="passwordHelpBlock">
                                                    <small id="passwordHelpBlock" class="form-text text-muted">Enter your password for authorization.</small>
                                                </div>

                                                <button class="btn btn-primary" type="submit">Buy LTT unit(s)</button>
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
@section('scripts')
    <script>
        function changeAmount() {
            var quantity = 1;
            var newAmount = 0;
            var skillsSelect = document.getElementById("paymentmethod");
            var selectedValue = skillsSelect.options[skillsSelect.selectedIndex].value;
            quantity = document.getElementById('numberofpieunits').value;

            // Calculate current amount with the price of pie
            newAmount = quantity * {{ $pie_price }};

            // display value
            document.getElementById('ramount').value = newAmount;
            document.getElementById('damount').value = newAmount;
        }

        function getPaystackCharge(amount) {
            var paystack_percent_charge = {{ (float) App\Helpers::settings('paystack_percent_charge') }};
            var paystack_flat_fee = {{ (float) App\Helpers::settings('paystack_flat_fee') }};

            // Paystack do not charge #100 on amount below 2500
            if (amount < 2500){
                return (paystack_percent_charge * amount);
            }else{
                return ((paystack_percent_charge * amount) + paystack_flat_fee);
            }
        }

    </script>
@endsection
