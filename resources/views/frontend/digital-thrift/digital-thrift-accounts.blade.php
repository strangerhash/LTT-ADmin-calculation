@extends('layouts.app.main')
@section('title', 'Short Term Thrifts')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
           <!-- Breadcrumb -->
           <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Short Term Thrift</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Accounts</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="list"></i></span></span>Short Term Thrifts Accounts</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all Short Term Thrift units bought so far, in descending order.</p>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap table-responsive">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>STT Unit ID</th>
                                                    <th>Username</th>
                                                    <th>Date Created</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($records as $key => $mt)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>ISCSTT-00{{$mt->id}}</td>
                                                        <td>{{ $mt->username }}</td>
                                                        <td>{{ $mt->created_at->format('jS M, Y')  }}</td>
                                                        <td>
                                                            @if ($mt->is_thrift_completed == 0)
                                                                <span class="badge badge-warning">Active</span>
                                                            @else
                                                                <span class="badge badge-success">Thrift Completed</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($mt->is_thrift_completed == 0)
                                                                <a href="{{ route('digital-thrift-single-account', [$mt->id] ) }}">
                                                                    <span class="badge badge-primary">View Matrix</span>
                                                                </a>
                                                            @else
                                                                <span class="badge badge-success">Thrift Completed</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <th colspan="6" class="text-center">No Short Term Thrifts unit purchased.</th>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            {{ $records->appends(['sort' => 'is_thrift_completed'])->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Row -->

            </div>
            <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
