@extends('layouts.app.main')
@section('title', 'My LTT accounts')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Long Term Thrift</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Accounts</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>My LTT Accounts</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all Long Term Thrift (LTT) units, in descending order.</p>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap table-responsive">
                                        <table id="datable_1" class="table table-hover w-100 display text-center pb-30">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>LTT ID</th>
                                                    <th>Start Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Amount</th>
                                                    <th>Total<br>Markup</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @forelse ($records as $key => $pie)
                                                    <tr>
                                                        <td> {{ $key + 1 }} </td>
                                                        <td> {{ App\Helpers::settings('pie_account_id') .'' .$pie->id }}</td>
                                                        <td> {{ $pie->start_date }}</td>
                                                        <td> {{ $pie->end_date }}</td>
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
                                                            <a class="btn btn-primary btn-sm" href="{{ route('pie-single-account', [$pie->id] ) }}">
                                                                View
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
                <!-- /Row -->

            </div>
            <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection

@section('scripts')

@endsection
