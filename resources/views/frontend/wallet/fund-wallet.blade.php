@extends('layouts.app.main')
@section('title', 'Fund Wallet')
@section('styles')

@endsection
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fund Wallet</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="credit-card"></i></span></span>Add money to your account</h4>
            </div>
            <!-- /Title -->

            {{-- Include error --}}
            @include('layouts.partials.error')
            {{-- /Include error --}}

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="hk-row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Add money to your account</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-activity user-activity-sm">
                                            <form method="post" enctype="multipart/form-data" action="{{ route('fund-wallet') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" name="displayamount" id="display-amount" aria-describedby="helpamount" placeholder="0.0" required="required" onchange="changeAmount()" value="{{ old('displayamount') ?? '' }}">
                                                    <input type="hidden" name="ramount" id="new-amount">
                                                    <input type="hidden" name="amount" id="kobo-amount">
                                                    <small id="helpamount" class="form-text text-muted">You are paying <span id="new-amount-disp" class="text-danger"></span></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="paymentmethod">Payment Method</label>
                                                    <select class="form-control" name="paymentmethod" onchange="displayPaymentForm(); changeAmount()" id="paymentmethod">
                                                        <option value="0" selected="selected">Select</option>
                                                        <option value="4">Online Payment</option>
                                                        <option value="5">Bank Transfer</option>
                                                    </select>
                                                    <small id="helppaymentmethod" class="form-text text-muted">How do you want to pay?</small>
                                                </div>
                                                <div class="form-group" id="for_proofofpayment">
                                                    <label for="paymentmethod">Upload Proof of Payment</label>
                                                    <div class="form-group">
                                                        <input id="proofofpayment" class="form-control-file" type="file" name="proofofpayment" value="">
                                                    </div>
                                                    <small id="helpproofmentmethod" class="form-text text-muted">Evident of payment</small>
                                                </div>
                                                <div class="form-group" id="for_depositorsname">
                                                    <label for="depositorsname">Depositor's Name</label>
                                                    <div class="form-group">
                                                        <input id="depositorsname" type="text" class="form-control" placeholder="Depositor's Name" name="depositors_name" value="{{ old('depositors_name') ?? '' }}">
                                                    </div>
                                                    <small id="helpdepositorsname" class="form-text text-muted">This must correspond with the teller details or bank holder's name</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    <small class="form-text text-muted">Enter your account password.</small>
                                                </div>

                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                <input type="hidden" name="orderID" value="345">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                                                <input type="hidden" name="metadata[sender]" value="0" >
                                                <input type="hidden" name="metadata[amount]" id="paystackamount" value="1" >

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Fund Wallet Record(s)</h6>
                                    </div>
                                    <div class="card-body pa-0">
                                        <div class="table-wrap table-responsive">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Amount</th>
                                                            <th class="text-center">Paid Using</th>
                                                            <th class="text-center">Status</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($records as $key => $record)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>₦{{ $record->amount }}</td>
                                                                <td class="text-center"> <span class="badge badge-md badge-pill badge-primary">{{ ($record->payment_method == 1) ? 'Bank Deposit' : 'Paystack' }}</span> </td>
                                                                <td class="text-center">
                                                                    @if ((int)$record->verified == 0)
                                                                        <span class="badge badge-info badge-pill">Pending</span>
                                                                    @elseif ((int)$record->verified == 1)
                                                                        <span class="badge badge-success badge-pill">Verified</span>
                                                                    @else
                                                                        <span class="badge badge-danger badge-pill">Cancelled</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="4">You have not funded your wallet.</td>
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
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection


@section('scripts')
    <script>

        $(window).on('load',function(){
            $('#for_proofofpayment').hide();
            $('#for_depositorsname').hide();
            $('#for_depositedamount').hide();
        });

        function displayPaymentForm() {
            var paymentMethod = document.getElementById("paymentmethod");
            var selectedValue = paymentMethod.options[paymentMethod.selectedIndex].value;

            // Hide or Show Proof of Payment
            if(selectedValue == 4){
                $('#for_proofofpayment').hide();
                $('#for_depositorsname').hide();
            }
            if(selectedValue == 0){
                $('#for_proofofpayment').hide();
                $('#for_depositorsname').hide();
            }
            if(selectedValue == 5){
                $('#for_proofofpayment').show();
                $('#for_depositorsname').show();
            }
        }

        function changeAmount() {
            var quantity = 1;
            var newAmount = 0;
            var skillsSelect = document.getElementById("paymentmethod");
            var selectedValue = skillsSelect.options[skillsSelect.selectedIndex].value;

            // Calculate current amount with the price of pie
            newAmount = $('#display-amount').val();
            $('#paystackamount').val(newAmount);

            // If Paystack Option change amount else
            if(selectedValue == 4){
                // Add charge to it
                newAmount = Number(newAmount) + Number(getPaystackCharge(newAmount));
            }

            $('#kobo-amount').val(Number(newAmount).toFixed(2) * 100)
            $('#new-amount-disp').html(Number(newAmount).toFixed(2))
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
