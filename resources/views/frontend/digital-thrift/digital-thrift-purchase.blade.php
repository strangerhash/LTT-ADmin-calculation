@extends('layouts.app.main')
@section('title', 'Purchase Short Term Thrift Units')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('digital-thrift-accounts') }}">Short Term Thrift</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase units</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="gift"></i></span></span>Purchase
                        short term thrifts unit(s)</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
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
                        <div class="col-md-5 col-12">
                            <section class="hk-sec-wrapper">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="{{ route('digital-thrift-purchase') }}" id="purchase-form" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="numberofmtpacks">How many short term thrift unit(s)</label>
                                                        <input type="number" min="1" max="2" value="0"
                                                            onchange="changeAmount()"
                                                            class="form-control"
                                                            required name="quantity" id="numberofmtpacks" aria-describedby="helpnoofmtpacks" placeholder="Number of STT packs">
                                                        <small id="helpnoofmtpacks" class="form-text text-danger">Note: You can only purchase 2 STT units pack per day</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="paymentmethod">Payment Method</label>
                                                        <select class="form-control" name="paymentmethod" id="paymentmethod" onchange="changeAmount()" required>
                                                            <option value="11" selected>Total Wallet Balance ({{'₦'.Auth::user()->total_wallet_balance}})</option>
                                                        </select>
                                                        <small id="helppaymentmethod" class="form-text text-muted">Note: Online payment has a transaction charge</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" readonly
                                                            class="form-control" name="" value="0" id="damount" aria-describedby="helpamount" placeholder="0">
                                                        <input type="hidden" name="amount" id="ramount" value="0">
                                                        <small id="helpamount" class="form-text text-muted">Total amount to be paid</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userpassword">Password</label>
                                                        <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="xxxxxxxx" aria-describedby="passwordHelpBlock" required>
                                                        <small id="passwordHelpBlock" class="form-text text-muted">Enter password for authorization.</small>
                                                    </div>
                                                    <button class="btn btn-primary" onclick="submitForm()" id="submit-form">Buy Short Term Thrift Unit(s)</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="card">
                                <div class="card-header card-header-action">
                                    <h6>Purchased short term thrifts record(s)</h6>
                                </div>
                                <div class="card-body pa-0">
                                    <div class="table-wrap table-responsive">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Amount</th>
                                                        <th class="text-center">Qty</th>
                                                        <th>Payment Method</th>
                                                        <th>Date Created</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($records as $key => $record)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>₦ {{ $record->amount }}</td>
                                                            <td class="text-center">{{ $record->quantity }}</td>
                                                            <td class="text-center"> <span class="badge badge-md badge-pill badge-primary">{{ json_decode(App\Helpers::settings('wallet_code'), true)[$record->paymentmethod]  }}</span> </td>
                                                            <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center" colspan="5">You have not made any withdrawals.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="table-wrap table-responsive">
                                        {{ $records->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
            quantity = document.getElementById('numberofmtpacks').value;

            // Calculate current amount with the price of pie
            newAmount = quantity * {{ $mt_price }};

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
