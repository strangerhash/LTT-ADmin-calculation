@extends('administrator.layouts.app-master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18">Wallets</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Wallets</a></li>
                            <li class="breadcrumb-item active">Incoming Funds</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Hoverable rows</h4>
                            <p class="card-title-desc">Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.</p>

                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr  class="text-center">
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Depositor's Name</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($records as $key => $record)
                                            <tr  class="text-center">
                                                <th scope="row"> {{ $key+1 }} </th>
                                                <td>₦{{ $record->amount }}</td>
                                                <td>{{ $record->depositor_name }}</td>
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
                                                <td>
                                                    <div class="text-center d-none d-md-block">
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="mdi mdi-settings mr-2"></i> Settings
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">

                                                                @if ((int)$record->verified == 0 && $record->file_name != '')
                                                                    <a class="dropdown-item" href="{{ asset('/proofs_of_payment/' . $record->file_name) }}">View PoP</a>
                                                                    <a class="dropdown-item" href="{{ route('incoming.funds.approve', [App\Helpers::encodeId($record->user_id), App\Helpers::encodeId($record->id)]) }}">Approve</a>
                                                                    <a class="dropdown-item" href="{{ route('incoming.funds.decline', [App\Helpers::encodeId($record->user_id), App\Helpers::encodeId($record->id)]) }}">Decline</a>
                                                                @elseif(((int) $record->verified == 1 || (int) $record->verified == 2) && $record->file_name != '')
                                                                    <a class="dropdown-item" href="{{ asset('/proofs_of_payment/' . $record->file_name) }}">View PoP</a>
                                                                @else
                                                                    <a class="dropdown-item" href="#">No Action</a>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th colspan="7" class="text-center">No incoming runds</th>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-wrap table-responsive">
                                {{ $records->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @include('administrator.layouts.app-footer')

</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
