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
                <li class="breadcrumb-item active" aria-current="page">Buy Electricity - {{ $company }}</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="credit-card"></i></span></span>Buy Electricity - {{$company}}</h4>
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
                                        <h6>Purchase Electricity</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-activity user-activity-sm">
                                            <form method="POST" action="{{ url('/withdrawal/request') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Payment Option</label>
                                                    <select class="form-control custom-select">
                                                        <option selected>Select</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                    <small class="form-text text-muted">How do you want to pay?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Electricity Company</label>
                                                    <select class="form-control custom-select" disabled name="company">
                                                        <option value="{{$company}}" selected>{{$company}}</option>
                                                    </select>
                                                    <small class="form-text text-muted">Electricity company you're paying into</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meter Type</label>
                                                    <select class="form-control custom-select">
                                                        <option selected>Select</option>
                                                        <option value="1">Prepaid</option>
                                                        <option value="2">Postpaid</option>
                                                    </select>
                                                    <small class="form-text text-muted">Select the meter type</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Meter Number</label>
                                                    <input type="text" name="amount" value="" class="form-control" placeholder="Meter Number">
                                                    <small class="form-text text-muted">Your meter number</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile Number </label>
                                                    <input type="text" name="amount" value="" class="form-control" placeholder="080xxxxxxxx">
                                                    <small class="form-text text-muted">Enter your registered phone number</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Amount </label>
                                                    <input type="text" name="amount" value="" class="form-control" placeholder="N0.0">
                                                    <small class="form-text text-muted">How much electricity are you buying</small>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label>Account Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                                    <small class="form-text text-muted">Enter your account password.</small>
                                                </div> --}}
                                                <button type="submit" class="btn btn-primary">Purchase {{$company}} Electricity</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Electricity Purchase Record(s)</h6>
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
                                                        {{-- @forelse ($withdrawals as $key => $withdrawal)
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
                                                                <td>{{ $withdrawal->date_created }}</td>
                                                            </tr> --}}
                                                        {{-- @empty --}}
                                                            <tr>
                                                                <td class="text-center" colspan="4">You have not made any withdrawals.</td>
                                                            </tr>
                                                        {{-- @endforelse --}}
                                                    </tbody>
                                                </table>
                                            </div>
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
