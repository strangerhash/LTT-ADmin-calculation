@extends('recharge.layouts.app.main')
@section('title', 'Purchase Data Bundle')
@section('styles')

@endsection
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('recharge-dashboard') }}">Dashboard</a></li>
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
            @include('recharge.layouts.partials.error')
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
                                            <form action="{{ route('recharge-fund-wallet') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" name="amount" aria-describedby="helpamount" placeholder="0.0" required>
                                                    <small id="helpamount" class="form-text text-muted">How much do you want to add to your account?</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="paymentmethod">Payment Method</label>
                                                    <select class="form-control" name="paymentmethod" id="paymentmethod" required>
                                                        <option value="4">Online Payment</option>
                                                    </select>
                                                    <small id="helppaymentmethod" class="form-text text-muted">How do you want to pay?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    <small class="form-text text-muted">Enter your account password.</small>
                                                </div>
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                <input type="hidden" name="orderID" value="345">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                                <input type="hidden" name="custom_metadata[sender]" value="12">  {{-- required --}}
                                                <button class="btn btn-primary" type="submit">Fund Wallet</button>
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
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($records as $key => $record)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>₦{{ $record->amount }}</td>
                                                                <td class="text-center"> <span class="badge badge-md badge-pill badge-primary">{{ json_decode(App\Helpers::settings('wallet_code'), true)[$record->wallet]  }}</span> </td>
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

@endsection
