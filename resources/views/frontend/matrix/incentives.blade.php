@extends('layouts.app.main')
@section('title', 'Incentives Earned')
@section('content')

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Container -->
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Matrix</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Incentives</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>Incentives Earned</h4>
                </div>
                <!-- /Title -->

                {{-- Include error --}}
                @include('layouts.partials.error')
                {{-- /Include error --}}

                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <section class="hk-sec-wrapper">
                            <p class="mb-40">This shows a list of all your incentives earned by stage.</p>

                            <div class="row">
                                    <div class="col-sm">
                                        <div class="table-wrap table-responsive">
                                            <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Matrix</th>
                                                        <th>Incentive</th>
                                                        <th>Date Earned</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($records as $key => $record)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{ json_decode(App\Helpers::settings('matrix_levels'), true)[(int)$record->level] }}</td>
                                                            <td>
                                                                <?php
                                                                    $collected = $record->incentive_id;
                                                                    $incentives = json_decode(App\Helpers::settings('matrix_incentives'), true);
                                                                    if($record->level == 0){
                                                                        echo  'No Incentive(s)';
                                                                    }else{
                                                                        echo '<table>';
                                                                        foreach ($incentives as $key => $incentive) {
                                                                            echo '<tr>';

                                                                            if($incentive["stage"] == $record->level){
                                                                                echo  '<td>' . $incentive["desc"] . '<td>';
                                                                                if(str_contains($collected, $incentive["code"])){
                                                                                    echo '<td><span class="badge badge-success badge-pill">Collected</span></td>';
                                                                                }else{
                                                                                    echo '<td><span class="badge badge-warning badge-pill">Pending</span></td>';
                                                                                }
                                                                            }
                                                                            echo '</tr>';
                                                                        }
                                                                        echo '</table>';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>{{ date('jS M, Y', strtotime($record->date_created)) }}</td>
                                                        </tr>
                                                    @empty
                                                    <tr>
                                                        <th colspan="4" class="text-center">You have not earned any incentives.</th>
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
