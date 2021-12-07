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
                <li class="breadcrumb-item active" aria-current="page">Buy Data Bundle</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <!-- Container -->
        <div class="container">
            <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="credit-card"></i></span></span>Buy Data Bundle</h4>
            </div>
            <!-- /Title -->

            {{-- Include error --}}
            @include('recharge.layouts.partials.error')
            {{-- /Include error --}}

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="hk-row">
                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Purchase Data Bundle</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="user-activity user-activity-sm">
                                            <form method="POST" action="{{ route('recharge-data-bundle') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Payment Option</label>
                                                    <select class="form-control custom-select" name="paymentmethod" required>
                                                        <option selected>Select</option>
                                                        <option value="11">My Purse - PIE Account ({{'₦'.Auth::user()->wallet->pie }})</option>
                                                        <option value="12">My Purse - Matrix Account ({{'₦'.Auth::user()->wallet->balance }})</option>
                                                        <option value="13">My Purse - Recharge Account ({{'₦'.Auth::user()->recharge->wallet }})</option>
                                                    </select>
                                                    <small class="form-text text-muted">How do you want to pay?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile Network</label>
                                                    <select class="form-control custom-select" name="mobilenetwork" id="mobilenetwork" required>
                                                        <option selected>Select</option>
                                                        @foreach (json_decode(App\Helpers::settings('recharge_airtime_code'), true) as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="form-text text-muted">Which mobile network do you want?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Data Bundle Plan</label>
                                                    <select name="dataplan" id="dataplan" class="form-control custom-select" required>
                                                        <option selected>Select Plan</option>
                                                    </select>
                                                    <small class="form-text text-muted">Select the data plan you want?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Data Amount</label>
                                                    <input type="number" min="10" readonly name="amount" value="" class="form-control" id="amount" placeholder="Airtime Amount" required>
                                                    <small class="form-text text-muted">How much airtime do you want to purchase?</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile Number(s) </label>
                                                    <input type="text" name="phone" value="" class="form-control" placeholder="08xxxxxxxxx" required>
                                                    <small class="form-text text-muted">Number you want to recharge</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>Account Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    <small class="form-text text-muted">Enter your account password.</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Purchase Data</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-header card-header-action">
                                        <h6>Data Bundle Purchase Record(s)</h6>
                                    </div>
                                    <div class="card-body pa-0">
                                        <div class="table-wrap table-responsive">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Amount</th>
                                                            <th>Plan</th>
                                                            <th>Reciever</th>
                                                            <th class="text-center">Provider</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($records as $key => $record)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>₦{{ $record->amount }}</td>
                                                                <td>{{ $record->plan }}</td>
                                                                <td> {{ $record->phone_number }} </td>
                                                                <td class="text-center"> <span class="badge badge-md badge-pill badge-info">{{ json_decode(App\Helpers::settings('recharge_airtime_code'), true)[$record->provider]  }} </span></td>
                                                                <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td class="text-center" colspan="6">You have not purchased any data.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="table-wrap table-responsive">
                                            {{ $records->links() }}
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
<script>

    $('#mobilenetwork').on('change', function () {
        var option = this.value
        var list2 = {!! App\Helpers::settings('recharge_data_plans') !!}

        var html = '<select name="dataplan" id="dataplan" onchange="getOption()" class="form-control custom-select">';
        html += '<option selected>Select Plan</option>';
        list2.forEach((element, index) => {
            if(element.network == option){
                // Add option to string variable
                html += '<option value="' + (index + 1) + '">' + element.desc + ' @ ₦' + element.amount + '</option>';
            }
        });

        html += '</select>';
        $('#dataplan').replaceWith(html)

    })

    function getOption() {
        var e = document.getElementById("dataplan");
        var plan = e.options[e.selectedIndex].value;

        var list2 = {!! App\Helpers::settings('recharge_data_plans') !!}

        list2.forEach((element, index) => {
            if((index + 1) == plan){
                $('#amount').val(element.amount)
                $('#metadataplan').val(plan)
                $('#metanetworkprovider').val(element.network)
                $('#metadesc').val(element.desc)
                return;
            }
        });
    }

</script>
@endsection
