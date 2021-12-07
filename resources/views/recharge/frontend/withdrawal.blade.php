@extends('recharge.layouts.app.main')
@section('title', 'Withdraw')
@section('styles')

@endsection
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('recharge-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Withdrawal</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="credit-card"></i></span></span>Withdraw money from your account</h4>
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
                                        <h6>Withdraw money from your account</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-activity user-activity-sm">
                                            <form action="{{ route('recharge-withdrawal') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" min="100" name="amount" aria-describedby="helpamount" placeholder="0.0" required>
                                                    <small id="helpamount" class="form-text text-muted">How much do you want to withdraw from your account?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    <small class="form-text text-muted">Enter your account password.</small>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Withdraw money</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Withdrawal Record(s)</h6>
                                    </div>
                                    <div class="card-body pa-0">
                                        <div class="table-wrap table-responsive">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Amount</th>
                                                            <th class="text-center">Status</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($records as $key => $record)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>₦{{ $record->amount }}</td>
                                                                <td class="text-center">
                                                                    @if ($record->status == 0)
                                                                        <span class="badge badge-dark">Processing</span>
                                                                    @elseif($record->status == 1)
                                                                        <span class="badge badge-success">Successful</span>
                                                                    @else
                                                                        <span class="badge badge-danger">Rejected</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="4">You have not made any withdrawal.</td>
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
