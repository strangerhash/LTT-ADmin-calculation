@extends('recharge.layouts.app.main')
@section('title', 'Dashboard')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
            <!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">Dashboard</h2>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
                            <div class="col-sm-12">


                                {{-- Include error --}}
                                @include('recharge.layouts.partials.error')
                                {{-- /Include error --}}

                                {{-- General Message --}}
                                @if (App\Helpers::settings('general_broadcast_message') != '')
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {!! App\Helpers::settings('general_broadcast_message') !!}
                                    </div>
                                @endif

                                <div class="card-group hk-dash-type-2">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Balance</span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-6 text-dark mb-5" id="recharge-balance"></span>
                                                <small class="d-block">Recharge Purse Balance.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Total Commission Earned</span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-6 text-dark mb-5"><span class="counter-anim"  id="total-commission"></span></span>
                                                <small class="d-block">Total commission.</small>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Total Transactions</span>
                                                </div>
                                            </div>
                                            <div>
                                            <span class="d-block display-6 text-dark mb-5" id="total-transactions">{{ (Auth::user()->matrix_type) ? Auth::user()->matrix_type->name : '-' }}</span>
                                                <small class="d-block">Your current matrix level.</small>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Total Referrals</span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-6 text-dark mb-5" id="total-referrals"></span>
                                                <small class="d-block">Total number of referrals.</small>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div>
                                                    <span class="d-block font-15 text-dark font-weight-500">Total Downlines</span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="d-block display-6 text-dark mb-5" id="total-downlines"></span>
                                                <small class="d-block">Total number of referrals.</small>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mt-40 mb-30">
                            <h5 class="d-flex align-items-end">Your Activities <i class="ion ion-md-help-circle-outline text-light font-21 ml-10" data-toggle="tooltip" data-placement="top" title="Your recent registration activities"></i></h5>
                        </div>
                        <div class="hk-row">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div> --}}
                        <div class="mt-40 mb-30">
                            <h5 class="d-flex align-items-end">Your Activities <i class="ion ion-md-help-circle-outline text-light font-21 ml-10" data-toggle="tooltip" data-placement="top" title="Your recent registration activities"></i></h5>
                        </div>
                        <div class="hk-row">
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>My Downlines</h6>
                                    </div>
                                    <div class="card-body pa-0">
                                        <div class="table-wrap table-responsive">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Username</th>
                                                            <th>Full Name</th>
                                                            <th>Date Joined</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($referrals as $user)
                                                            <tr>
                                                                <td>{{$user->email}}</td>
                                                                <td>{{$user->fname}} {{$user->lname}}</td>
                                                                <td>{{ $user->created_at->format('jS M, Y') }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="3">You have not made any referral.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Commissions Earned</h6>
                                    </div>
                                    <div class="card-body pa-0">
                                        <div class="table-wrap table-responsive">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Amount</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($commissions as $key => $commission)
                                                            <tr>
                                                                <td>{{$key + 1}}</td>
                                                                <td>{{ $commission->commission }}</td>
                                                                <td>{{ $commission->comment }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="3">You have not earned any commission.</td>
                                                            </tr>
                                                        @endforelse
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
            <!-- /Container --><!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Powered by<a href="https://iscubenetworks.com" class="text-dark" target="_blank">ISCUBE International.</a> © 2017 - {{ date('Y') }}.</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

@endsection

@section('scripts')
<script>
    // window.onbeforeunload = function() {
    //     return "Dude, are you sure you want to leave? Think of the kittens!";
    // }
    $(document).ready(function(){

        showPleaseWait();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: '{{ url("/recharge/refresh-account") }}',
            success:function(data){
                $('#total-referrals').text(data.referrals);
                $('#total-transactions').text(data.transactions);
                $('#total-commission').text("₦ " + data.commission);
                $('#total-downlines').text(data.downlines);
                $('#recharge-balance').text("₦ " + data.balance);
            }
        })
        .fail(function (error) {
            console.log(error)
        })
        .done(function( msg ) {
            hidePleaseWait()
        });
    });

    function showPleaseWait() {
        if (document.querySelector("#pleaseWaitDialog") == null) {
            var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">\
                <div class="modal-dialog">\
                    <div class="modal-content">\
                        <div class="modal-header">\
                            <h4 class="modal-title">Please wait...</h4>\
                        </div>\
                        <div class="modal-body">\
                            <div class="progress">\
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                            </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>';
            $(document.body).append(modalLoading);
        }

        $("#pleaseWaitDialog").modal("show");
    }

    /**
    * Hides "Please wait" overlay. See function showPleaseWait().
    */
    function hidePleaseWait() {
        $("#pleaseWaitDialog").modal("hide");
    }
</script>
@endsection
