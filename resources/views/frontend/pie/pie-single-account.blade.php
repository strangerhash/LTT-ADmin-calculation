@extends('layouts.app.main')
@section('title', 'LTT Account')
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
                    <div class="col-md-8">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This is list of all transactions on this LTT account, in descending order.</p>
                            <div class="row">
                                <table id="datable_1" class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Amount</th>
                                            <th>Entry</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($records as $key => $record)
                                            <tr>
                                                <td>{{ $key+1}}</td>
                                                <td>{{ '₦' . abs($record->amount) }}</td>
                                                <td>
                                                    <span class="badge badge-danger">Debit</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Approved</span>
                                                </td>
                                                <td>{{ date_format(date_create($record->date_created), 'Y-m-d') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No transactions</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-profile-feed">
                            <div class="card-header card-header-action">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <div class="text-capitalize font-weight-500 text-dark">LTT Details</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-6 border-right pr-0">
                                    <div class="pa-15">
                                        <span class="d-block display-6 text-dark mb-5"> {{ $pie->no_of_pie }}</span>
                                        <span class="d-block text-capitalize font-14">No. of LTT units</span>
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
                                <li class="list-group-item"><span><i class="ion ion-md-calendar font-18 text-light-20 mr-10"></i><span>Start Date:</span></span><span class="ml-5 text-dark">{{ $pie->start_date }}</span></li>
                                <li class="list-group-item"><span><i class="ion ion-md-calendar font-18 text-light-20 mr-10"></i><span>End Date:</span></span><span class="ml-5 text-dark">{{ $pie->end_date }}</span></li>
                                <li class="list-group-item">
                                    <div class="card-group">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <a class="btn btn-success btn-lg" href="{{ route('pie-single-account-withdrawal', [$pie->id] ) }}">Withdraw</a>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <a class="btn btn-danger btn-lg" href="{{ route('pie-account-close', [$pie->id] ) }}">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
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
