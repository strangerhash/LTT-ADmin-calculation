@extends('layouts.app.main')
@section('title', 'Upgrade Account')

@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upgrade Account</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>Upgrade Account</h4>
                </div>

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- /Title -->
                @if (Auth::user()->is_upgraded == 1)
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-8 offset-md-2 col-12">
                            <section class="hk-sec-wrapper">
                                <h5 class="hk-sec-title card-header text-center">Information</h5>
                                <p class="mb-10 mt-20 lead text-muted text-center">Your account has been upgraded already.</p>
                            </section>
                        </div>
                    </div>
                    <!-- /Row -->
                @else
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-8 offset-md-2 col-12">
                            <section class="hk-sec-wrapper">
                                <h5 class="hk-sec-title card-header text-center">Information</h5>
                                <!--<p class="mb-40 lead text-muted">Welcome! Finally, we cracked the code that turns the matrix into a winner with PIE Short Term Thrift system.  PIE Plan helps members and non-members to create more money passively and conserve it so that no member’s money is ever lost but appreciates.</p>-->
                                <p class="mb-40 lead text-muted">Account Upgrade costs ₦{{ App\Helpers::settings('matrix_upgrade_amount')}}, and it is made up of ₦4K inactive Long Term Thrift [LTT] units and ₦1K admin fee. Please click on the button below to proceed.</p>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <form method="POST" action="{{ url('/user/upgrade') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                                    @csrf
                                                    <div class="row" style="margin-bottom:40px;">
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                            <input type="hidden" name="amount" value="{{ App\Helpers::getChargedAmount('matrix_upgrade_amount') * 100 }}" />
                                                            <input type="hidden" name="quantity" value="1">
                                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['sender' => 1]) }}" >
                                                            <p>
                                                                <button type="submit" class="btn btn-primary btn-wth-icon btn-lg btn-rounded"> <span class="icon-label"><span class="feather-icon"><i data-feather="credit-card"></i></span> </span><span class="btn-text">Pay with paystack</span></button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                @endif

            </div>
            <!-- /Container -->
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
