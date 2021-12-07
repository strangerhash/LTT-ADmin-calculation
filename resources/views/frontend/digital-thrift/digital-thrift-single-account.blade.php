@extends('layouts.app.main')
@section('title', 'Short Term Thrifts')
@section('styles')
<style>
    #tree {
        width: 100%;
        height: 100%;
        position: relative;
    }
</style>
@endsection

@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('digital-thrift-accounts') }}">Short Term Thrift</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('digital-thrift-accounts') }}">Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->pin_unique_value }}</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                    <!-- Title -->
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>{{ $user->pin_unique_value }} Matrix</h4>
                    </div>
                    <!-- /Title -->

                    {{-- Include error --}}
                    @include('layouts.partials.error')
                    {{-- /Include error --}}

                    <!-- Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <section class="hk-sec-wrapper">
                                <p class="mb-40">This shows the matrix for short term thrift: {{ $user->pin_unique_value }}.</p>
                                <div class="row">
                                    <div id="tree"></div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!-- /Row -->

                    {{-- Load Scripts for displaying matrix --}}
                    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
                    <script>
                        var db_data = {!! $user->matrix_users !!}
                        var chart = new OrgChart(document.getElementById("tree"), {
                            template: "isla",
                            enableSearch: true,
                            showXScroll: OrgChart.scroll.visible,
                            showYScroll: OrgChart.scroll.visible,
                            mouseScrool: OrgChart.action.zoom,
                            nodeBinding: {
                                field_0: "Full Name",
                                field_1: "Username",
                                field_2: "Phone Number"
                            },
                            nodes: db_data
                        });
                    </script>
                    {{-- /Load Scripts for displaying matrix --}}

                </div>
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
