@extends('layouts.app.main')
@section('title', 'Withdrawal')
@section('content')


    <!-- Main Content -->
    <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Withdrawal</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="credit-card"></i></span></span>Withdrawal</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
                            @if (Route::current()->uri == "withdrawal")
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header card-header-action">
                                            <h6>Request Withdrawal</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-activity user-activity-sm">
                                                <form method="POST" id="payment-form" action="{{ url('/withdrawal/request') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" name="amount" value="0.0" class="form-control" placeholder="Enter Amount" required>
                                                        <small class="form-text text-muted">How much do you want to withdraw.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Account Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                        <small class="form-text text-muted">Password is required for authorization.</small>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Request Withdrawal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header card-header-action">
                                            <h6>Withdraw from PIE to my Purse</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-activity user-activity-sm">
                                                <form method="POST" action="{{ url('/withdrawal/request') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Current Earning</label>
                                                        @isset($pie)
                                                            <input type="text" readonly value="₦ {{ $pie->current_earning }}" class="form-control" placeholder="Enter Amount">
                                                        @endisset
                                                        <small class="form-text text-muted">Amount you've earned on this account.</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" name="amount" value="" class="form-control" placeholder="Enter amount to withdraw">
                                                        <small class="form-text text-muted">How much do you want to withdraw?</small>
                                                    </div>
                                                    @isset($pie)
                                                        <input type="text" hidden class="form-control" value="{{ $pie->id }}" name="pie_account">
                                                    @endisset
                                                    <div class="form-group">
                                                        <label>Account Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                                        <small class="form-text text-muted">Enter your account password.</small>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Request Withdrawal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @isset($withdrawals)
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header card-header-action">
                                            <h6>Cash Withdrawal Record(s)</h6>
                                        </div>
                                        <div class="card-body pa-0">
                                            <div class="table-wrap table-responsive">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Trans. Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($withdrawals as $key => $withdrawal)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>₦ {{ $withdrawal->amount }}</td>
                                                                    <td>
                                                                        @if ($withdrawal->status == 0)
                                                                            <span class="badge badge-dark">Processing</span>
                                                                        @elseif($withdrawal->status == 1)
                                                                            <span class="badge badge-success">Successful</span>
                                                                        @else
                                                                            <span class="badge badge-danger">Rejected</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('jS M, Y', strtotime($withdrawal->date_created)) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td class="text-center" colspan="4">You have not made any withdrawals.</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
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
