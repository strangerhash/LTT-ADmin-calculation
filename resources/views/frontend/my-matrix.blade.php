@extends('layouts.app.main')
@section('title', 'My Matrix')
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
                    <li class="breadcrumb-item active" aria-current="page">My Matrix</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>My Matrix</h4>
                </div>
                <!-- /Title -->
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

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection

@section('scripts')
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script>
        var db_data = {!! Auth::user()->matrix_users !!}
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
                field_3: "Current Matrix",
                field_4: "Sponsor",
                field_5: "Parent",
                field_6: "System Unique ID",
                field_7: "S/N",
            },
            nodes: db_data
        });
    </script>
@endsection
