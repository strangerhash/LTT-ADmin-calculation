@extends('recharge.layouts.app.main')
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
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>Upgrade To Own A VTU Account</h4>
                </div>

                {{-- Include error --}}
                @include('recharge.layouts.partials.error')
                {{-- /Include error --}}

                <!-- /Title -->
                @if (Auth::user()->recharge->is_upgraded == 1)
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-8 offset-md-2 col-12">
                            <section class="hk-sec-wrapper">
                                <h5 class="hk-sec-title card-header text-center">Information</h5>
                                <p class="mb-10 mt-20 lead text-muted text-center">You already own a VTU.</p>
                            </section>
                        </div>
                    </div>
                    <!-- /Row -->
                @else
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="hk-sec-title card-header text-center">Information</h5>
                                    <p class="mb-40 lead text-muted">VTU Upgrade costs ₦5000, you'll recieve 25% this amount. Please click on the button below to proceed.</p>
                                    <div class="user-activity user-activity-sm">
                                        <form method="POST" action="{{ route('recharge-upgrade-vtu') }}" role="form">
                                            @csrf
                                            <div class="row" style="margin-bottom:40px;">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                                                    <input type="hidden" name="amount" value="{{ App\Helpers::getChargedAmount('recharge_upgrade_amount') }}" />
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
                    </div>
                @endif

            </div>
            <!-- /Container -->
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
