@extends('layouts.app.main')
@section('title', 'Downlines List')
@section('styles')

@endsection

@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Matrix</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Downlines</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>My Downlines</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
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
                                                        <th>Full name</th>
                                                        <th>Username</th>
                                                        <th class="text-center">Upgraded?</th>
                                                        <th class="text-center">Current Matrix</th>
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
                                                            <td class="text-center">
                                                                @if ((int)$record->is_upgraded == 1)
                                                                    <span class="badge badge-success badge-pill">Upgraded</span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill">Not Upgraded</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{ json_decode(App\Helpers::settings('matrix_levels'), true)[$record->current_matrix] }}
                                                            </td>
                                                            <td>{{ date('jS M, Y', strtotime($record->created_at)) }}</td>
                                                            <td>{{ date('jS M, Y', strtotime($record->last_login_at)) }}</td>
                                                        </tr>
                                                    @empty
                                                    <tr>
                                                        <th colspan="7" class="text-center">No records available.</th>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="text-center">
                                                <nav aria-label="Page navigation">
                                                  <ul class="pagination justify-content-center">
                                                    <li class="page-item">
                                                      <a class="page-link" href="{{ route('matrix-downlines', [$step - 10]) }}" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo; Previous</span>
                                                        <span class="sr-only">Previous</span>
                                                      </a>
                                                    </li>
                                                    <li class="page-item">
                                                      <a class="page-link" href="{{ route('matrix-downlines', [$step + 10]) }}" aria-label="Next">
                                                        <span aria-hidden="true">Next &raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                      </a>
                                                    </li>
                                                  </ul>
                                                </nav>
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
