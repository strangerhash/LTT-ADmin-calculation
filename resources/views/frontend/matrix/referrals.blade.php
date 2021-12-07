@extends('layouts.app.main')
@section('title', 'Referrals')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Matrix</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Referrals</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>My Referrals</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all your referrals.</p>

                            <div class="row">
                                    <div class="col-sm">
                                        <div class="table-wrap table-responsive">
                                            <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Full name</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Upgraded?</th>
                                                        <th>Current Matrix</th>
                                                        <th>Date Created</th>
                                                        <th>Last Login</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($records as $key => $record)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{ $record->fname . ' ' . $record->lname }}</td>
                                                            <td>{{ $record->username }}</td>
                                                            <td>{{ $record->email }}</td>
                                                            <td class="text-center">
                                                                @if ((int)$record->is_upgraded == 1)
                                                                    <span class="badge badge-success badge-pill">Upgraded</span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill">Not Upgraded</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (is_null($record->current_matrix))
                                                                    <span class="badge badge-danger badge-pill">Not Upgraded</span>
                                                                @else
                                                                    {{ json_decode(App\Helpers::settings('matrix_levels'), true)[$record->current_matrix] }}
                                                                @endif
                                                            </td>
                                                            <td>{{ date('jS M, Y', strtotime($record->created_at)) }}</td>
                                                            <td>{{ date('jS M, Y', strtotime($record->last_login_at)) }}</td>
                                                        </tr>
                                                    @empty
                                                    <tr>
                                                        <th colspan="8" class="text-center">You don't have any referrals yet.</th>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                {{ $records->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- /Container -->

        @include('layouts.app.footer')
    </div>
    <!-- /Main Content -->

@endsection
