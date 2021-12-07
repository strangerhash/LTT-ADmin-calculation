@extends('layouts.app.main')
@section('title', 'My PIE Accounts')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @if (Route::current()->uri != "pie-history")
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pie-history') }}">My PIE Accounts</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">My PIE Accounts</li>
                    @endif
                    @if (Route::current()->uri !== "pie-history")
                        <li class="breadcrumb-item active" aria-current="page">{{ $pie->id }}</li>
                    @endif
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>My PIE History</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                @if (Route::current()->uri == "pie-history")
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <p class="mb-40">This shows a list of all Long Term Thrift (LTT) units <em>(otherwise known as PIE units)</em> earned so far, in descending order.</p>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="table-wrap table-responsive">
                                            <table id="datable_1" class="table table-hover w-100 display text-center pb-30">
                                                <thead>
                                                    <tr>
                                                        {{-- <th>SN</th> --}}
                                                        <th>PIE ID</th>
                                                        <th>Start Date</th>
                                                        <th>Expiry Date</th>
                                                        <th>Amount</th>
                                                        <th>Total<br>Markup</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @forelse (Auth::user()->pie as $key => $pie)
                                                        <tr>
                                                            {{-- <td> {{ $key+1 }} </td> --}}
                                                            <td>{{ $pie->id }}</td>
                                                            <td>{{ $pie->start_date }}</td>
                                                            <td>{{ $pie->end_date }}</td>
                                                            <td>₦{{ $pie->amount }}</td>
                                                            <td>₦{{ $pie->current_earning }} </td>
                                                            <td>
                                                                @if (date("Y-m-d") == $pie->end_date)
                                                                    <span class="badge badge-dark">Expired</span>
                                                                @else
                                                                    <span class="badge badge-success">Active</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{ route('pie-view', [$pie->id] ) }}">
                                                                    <span class="badge badge-primary">View</span>
                                                                </a>
                                                                <br>
                                                                <a href="{{ route('pie-withdrawal', [$pie->id] ) }}">
                                                                    <span class="badge badge-success">Withdraw</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8">No records found.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-8">
                            <section class="hk-sec-wrapper">
                                <p class="mb-40">This is list of all transactions on this PIE account, in descending order.</p>
                                <div class="row">
                                    <table id="datable_1" class="table">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Entry</th>
                                                <th>Account</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($trans as $key => $transaction)
                                                <tr>
                                                    <td>{{ $key+1}}</td>
                                                    <td>{{ date_format(date_create($transaction->date_created), 'Y-m-d') }}</td>
                                                    <td>{{ '₦' . abs($transaction->amount) }}</td>
                                                    <td>
                                                        @if ($transaction->entry == 0)
                                                            <span class="badge badge-danger">Debit</span>
                                                        @else
                                                            <span class="badge badge-success">Credit</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($transaction->wallet == 11)
                                                            <span class="badge badge-info">PIE Account</span>
                                                        @elseif ($transaction->wallet == 12)
                                                            <span class="badge badge-info">Matrix Account</span>
                                                        @else
                                                            <span class="badge badge-info">Paystack</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($transaction->status == 0)
                                                        <span class="badge badge-info">Processing</span>
                                                        @elseif($transaction->status == 1)
                                                        <span class="badge badge-success">Approved</span>
                                                        @else
                                                        <span class="badge badge-danger">Declined</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $transaction->purpose }}</td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">No transactions</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-profile-feed">
                                <div class="card-header card-header-action">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="text-capitalize font-weight-500 text-dark">PIE Details</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-6 border-right pr-0">
                                        <div class="pa-15">
                                            <span class="d-block display-6 text-dark mb-5">{{ $pie->no_of_pie }}</span>
                                            <span class="d-block text-capitalize font-14">No. of PIE units</span>
                                        </div>
                                    </div>
                                    <div class="col-6 border-right px-0">
                                        <div class="pa-15">
                                            <span class="d-block display-6 text-dark mb-5">₦ {{ $pie->current_earning }}</span>
                                            <span class="d-block text-capitalize font-14">Total Earning</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><span><i class="ion ion-md-calendar font-18 text-light-20 mr-10"></i><span>Start Date:</span></span><span class="ml-5 text-dark">{{ date_create($pie->start_date)->format('jS M, Y')  }}</span></li>
                                    <li class="list-group-item"><span><i class="ion ion-md-calendar font-18 text-light-20 mr-10"></i><span>End Date:</span></span><span class="ml-5 text-dark">{{ date_create($pie->start_date)->format('jS M, Y')  }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- /Row -->

            </div>
            <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
