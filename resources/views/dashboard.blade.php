@extends('layouts.app.main')

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

                                @include('layouts.partials.error')

                                {{-- /Include error --}}



                                @if (Auth::user()->is_upgraded == 0)

                                    <div class="alert alert-warning text-danger">

                                        NB: Please try to upgrade before your downlines. Failure to do this <strong>may result to loosing your sponsor's bonuses</strong> when they <em>(your downlines)</em> cycle.

                                    </div>

                                @endif



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

                                                    <span class="d-block font-15 text-dark font-weight-500">LTT Units</span>

                                                </div>

                                            </div>

                                            <div>

                                                <span class="d-block display-6 text-dark mb-5" id="total_pie">{{ Auth::user()->count_pie_accounts }}</span>

                                                <small class="d-block">Number of <strong>active</strong> LTT units earned.</small>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="card card-sm">

                                        <div class="card-body">

                                            <div class="d-flex justify-content-between mb-5">

                                                <div>

                                                    <span class="d-block font-15 text-dark font-weight-500">STT Packs</span>

                                                </div>

                                            </div>

                                            <div>

                                                <span class="d-block display-6 text-dark mb-5"><span class="counter-anim"> {{ Auth::user()->matrix_thrifts_count }} </span></span>

                                                <small class="d-block">Number of STT Packs purchased.</small>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="card card-sm">

                                        <div class="card-body">

                                            <div class="d-flex justify-content-between mb-5">

                                                <div>

                                                    <span class="d-block font-15 text-dark font-weight-500">Matrix Level</span>

                                                </div>

                                            </div>

                                            <div>

                                            <span class="d-block display-6 text-dark mb-5" id="matrix-level">{{ (Auth::user()->matrix_type) ? Auth::user()->matrix_type->name : '-' }}</span>

                                                <small class="d-block">Your current matrix level.</small>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="card card-sm">

                                        <div class="card-body">

                                            <div class="d-flex justify-content-between mb-5">

                                                <div>

                                                    <span class="d-block font-15 text-dark font-weight-500">My Wallet : </span>

                                                </div>

                                            </div>

                                            <div>

                                                <span class="d-block display-6 text-dark mb-5" id="wallet-balance"></span>

                                                <small class="d-block">Total Balance. ({{'₦'.Auth::user()->total_wallet_balance}})</small>

                                            </div>

                                        </div>

                                    </div>



                                    <div class="card card-sm">

                                        <div class="card-body">

                                            <div style="height:50%">

                                                <div class="d-flex justify-content-between mb-5"></div>

                                                <div>

                                                    <span class="d-block display-6 text-dark mb-5" id="total-deposited"></span>

                                                    <small class="d-block">Total Deposited. {{ $my_fund_withdraw}}</small>

                                                </div>

                                            </div>

                                            <div style="height:50%">

                                                <div class="d-flex justify-content-between mb-5"></div>

                                                <div>

                                                    <span class="d-block display-6 text-dark mb-5" id="total-earnings"></span>

                                                    <small class="d-block">Total Earnings. {{ $total_earnings }}</small>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="hk-row">

                            <div class="col-lg-6">



                            </div>

                            <div class="col-lg-6">



                            </div>

                        </div>

                        <div class="mt-40 mb-30">

                            <h5 class="d-flex align-items-end">Your Activities <i class="ion ion-md-help-circle-outline text-light font-21 ml-10" data-toggle="tooltip" data-placement="top" title="Your recent registration activities"></i></h5>

                        </div>

                        <div class="hk-row">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="card-body pa-0">

                                        <div class="card-header card-header-action">

                                            <h6>Recent Referrals</h6>

                                        </div>

                                        <div class="table-wrap table-responsive">

                                            <div class="table-responsive">

                                                <table class="table table-hover mb-0">

                                                    <thead>

                                                        <tr>

                                                            <th>Username</th>

                                                            <th>Full Name</th>

                                                            <th>Date Joined</th>

                                                            <th>Status</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        @forelse ($referrals as $user)

                                                            <tr>

                                                                <td>{{$user->username}}</td>

                                                                <td>{{$user->fname}} {{$user->lname}}</td>

                                                                <td>{{ $user->created_at->format('jS M, Y') }}</td>

                                                                <td>

                                                                    @if ($user->is_upgraded == 1)

                                                                        <span class="badge badge-success">Upgraded</span>

                                                                    @else

                                                                        <span class="badge badge-danger">Not Upgraded</span>

                                                                    @endif

                                                                </td>

                                                            </tr>

                                                        @empty

                                                            <tr>

                                                                <td class="text-center" colspan="4">You have not made any referral. Use your <a href="{{'my-profile'}}">referral link</a> to invite people, and their names will appear here.</td>

                                                            </tr>

                                                        @endforelse

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- <div class="col-lg-4">

                                <div class="card">

                                    <div class="card-header card-header-action">

                                        <h6>Earned Incentives/Bonuses</h6>

                                    </div>

                                    <div class="card-body">

                                        <div class="user-activity user-activity-sm">



                                        </div>

                                    </div>

                                </div>

                            </div> --}}

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

    $(document).ready(function(){



        showPleaseWait();



        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            method: "POST",

            url: '{{ url("/refresh-account") }}',

            success:function(data){

                $('#wallet-balance').text("₦ " + data.wallet_balance);

                $('#pie-balance').text("₦ " + data.pie_balance);

                $('#matrix-level').text(data.matrix_level);

                $('#total_pie').text(data.total_pie);

                $('#total-deposited').text("₦ " + data.total_deposited);

                $('#total-earnings').text("₦ " + data.total_earnings);

            }

        })

        .fail(function (error) {

            console.log(error)

             hidePleaseWait()

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

