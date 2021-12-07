@extends('recharge.layouts.app.main')
@section('title', 'Geneology Tree')
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
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">My Network</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Geneology Tree</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>Geneology Tree</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('recharge.layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <section class="hk-sec-wrapper">
                                <div id="tree"></div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /Container -->
        <!-- /Container -->

        @include('recharge.layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection

@section('scripts')
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script>
        var db_data = {!! $data !!}
        var chart = new OrgChart(document.getElementById("tree"), {
            template: "isla",
            enableSearch: true,
            showXScroll: OrgChart.scroll.visible,
            showYScroll: OrgChart.scroll.visible,
            mouseScrool: OrgChart.action.zoom,
            nodeBinding: {
                field_0: "Full Name",
                field_1: "Username",
                field_2: "Phone Number",
            },
            nodes: db_data
        });
    </script>
@endsection
