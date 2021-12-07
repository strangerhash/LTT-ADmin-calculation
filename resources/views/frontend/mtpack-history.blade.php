@extends('layouts.app.main')
@section('title', 'My Matrix Thrifts')
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
                    <li class="breadcrumb-item active" aria-current="page">My Matrix Thrifts </li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                    <!-- Title -->
                    <div class="hk-pg-header">
                        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>My MT Pack History</h4>
                    </div>
                    <!-- /Title -->

                    {{-- Include error --}}
                    @include('layouts.partials.error')
                    {{-- /Include error --}}

                    @if (Route::current()->uri == "mtpack-history")
                        <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <section class="hk-sec-wrapper">
                                    <p class="mb-40">This shows a list of all Matrix Thrift (MT Pack) units bought so far, in descending order.</p>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="table-wrap table-responsive">
                                                <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                    <thead>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>MT Pack ID</th>
                                                            <th>Date Created</th>
                                                            <th>Expiry</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse (Auth::user()->matrix_thrifts as $key => $mt)
                                                            <tr>
                                                                <td>{{$key+1}}</td>
                                                                <td>{{$mt->pin_unique_value}}</td>
                                                                <td>{{ date_format($mt->created_at, date('Y-m-d')) }}</td>
                                                                <td>{{ date_format($mt->created_at, date('Y-m-d')) }}</td>
                                                                <td>
                                                                    @if ($mt->is_thrift_completed == 0)
                                                                        <span class="badge badge-warning">Active</span>
                                                                    @else
                                                                        <span class="badge badge-success">Thrift Completed</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($mt->is_thrift_completed == 0)
                                                                        <a href="{{ route('mt-view', [$mt->id] ) }}">
                                                                            <span class="badge badge-primary">View Matrix</span>
                                                                        </a>
                                                                    @else
                                                                        <span class="badge badge-danger">Disabled</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        <tr>
                                                            <th colspan="6">No MT Packs created.</th>
                                                        </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <div class="text-center">
                                                    {{ Auth::user()->matrix_thrifts->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- /Row -->
                    @else
                        <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12">
                                <section class="hk-sec-wrapper">
                                    <p class="mb-40">This shows a list of all Matrix Thrift (MT Pack) units bought so far, in descending order.</p>
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
                                    field_0: "name",
                                    field_1: "title",
                                    field_2: "phone"
                                },
                                nodes: db_data
                            });
                        </script>
                        {{-- /Load Scripts for displaying matrix --}}
                    @endif

                </div>
        <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
