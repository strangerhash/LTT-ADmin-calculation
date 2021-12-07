@extends('layouts.app.main')
@section('title', 'LTT Accounts')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Long Term Thrift</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pie-accounts') }}">Accounts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ App\Helpers::settings('pie_account_id') }}{{ $id }}</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>LTT Account: {{ App\Helpers::settings('pie_account_id') }}{{ $id }}</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header card-header-action">
                                <h6>Withdraw from LTT to my wallet</h6>
                            </div>
                            <div class="card-body">
                                <div class="user-activity user-activity-sm">
                                    <form method="POST" id="payment-form" action="{{ route('pie-account-withdrawal') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label>Current Earning</label>
                                                <input type="text" readonly value="₦ {{ $pie->current_earning }}" class="form-control" placeholder="Enter Amount" required>
                                            <small class="form-text text-muted">Amount you've earned on this account.</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" name="amount" value="" class="form-control" placeholder="Enter amount to withdraw" required>
                                            <small class="form-text text-muted">How much do you want to withdraw?</small>
                                        </div>
                                        <input type="text" hidden class="form-control" value="{{ $pie->id }}" name="pie_account">
                                        <div class="form-group">
                                            <label>Account Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            <small class="form-text text-muted">Enter your account password.</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Request Withdrawal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                @forelse ($records as $key => $record)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>₦ {{ $record->amount }}</td>
                                                        <td>
                                                            @if ($record->status == 0)
                                                                <span class="badge badge-dark">Processing</span>
                                                            @elseif($record->status == 1)
                                                                <span class="badge badge-success">Successful</span>
                                                            @else
                                                                <span class="badge badge-danger">Rejected</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ date_format(date_create($record->date_created), date('Y-m-d')) }}</td>
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
                                <div class="table-wrap table-responsive">
                                    {{ $records->links() }}
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
