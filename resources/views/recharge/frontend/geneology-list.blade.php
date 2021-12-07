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
                    <li class="breadcrumb-item active" aria-current="page">Geneology List</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>Geneology List</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('recharge.layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all your downlines.</p>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap table-responsive">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Username</th>
                                                    <th>Full Name</th>
                                                    <th>Phone</th>
                                                    <th>Date Upgraded</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($data as $key => $dt)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{ $dt->username }}</td>
                                                        <td>{{ $dt->fname . ' ' . $dt->lname }}</td>
                                                        <td>{{ $dt->phone }}</td>
                                                        <td>{{ date_format(date_create($dt->recharge->date_created), date('Y-m-d')) }}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <th colspan="4">No Downlines yet.</th>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{-- {{ $data->links() }} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /Container -->

        @include('recharge.layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
