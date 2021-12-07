@extends('layouts.app.main')
@section('title', 'PIE Transactions')
@section('styles')

@endsection

@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">PIE</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>PIE Transactions</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all your transactions.</p>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap table-responsive">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th class="text-center">Entry</th>
                                                    <th class="text-center">Payment Method</th>
                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($records as $key => $record)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{ $record->comment }}</td>
                                                        <td>₦{{ $record->amount }}</td>
                                                        <td class="text-center">
                                                            @if ($record->entry == 'credit')
                                                                <span class="badge badge-success badge-pill">{{ $record->entry }}</span>
                                                            @else
                                                                <span class="badge badge-danger badge-pill">{{ $record->entry }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center"> <span class="badge badge-md badge-pill badge-primary">{{ json_decode(App\Helpers::settings('wallet_code'), true)[$record->paymentmethod]  }}</span> </td>
                                                        <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <th colspan="6" class="text-center">You don't have any transactions yet.</th>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $records->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
