@extends('layouts.app.main')

@section('title', 'Quorum Matrix')

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

                    <li class="breadcrumb-item"><a href="#">Matrix</a></li>

                    <li class="breadcrumb-item active" aria-current="page">{{ (Auth::user()->matrix_type) ? Auth::user()->matrix_type->name : '-' }} Matrix</li>

                </ol>

            </nav>

            <!-- /Breadcrumb -->



            <!-- Container -->

            <div class="container">

                <!-- Title -->

                <div class="hk-pg-header">

                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>{{ (Auth::user()->matrix_type) ? Auth::user()->matrix_type->name : '-' }} Matrix</h4>

                </div>

                <!-- /Title -->



                {{-- Include error --}}

                @include('layouts.partials.error')

                {{-- /Include error --}}



                <!-- Row -->

                <div class="row">

                    <div class="col-md-12">

                        <p class="mb-40">This shows the user's current matrix</p>

                        <section class="hk-sec-wrapper">

                            <div id="tree"></div>
                           <table class="table">
                            <thead>
                                <tr>
                                 <th>Sr No</th> 
                                 <th>Name</th> 
                                 <th>sponsor id</th> 
                                 <th>Position</th> 
                                 <th>Current Matxi</th> 
                                 <th>Pin Unique ID</th>   

                                </tr>

                            </thead>
                            <tbody>
                                @foreach($users as $key=> $user)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->current_matrix}}</td>
                                    <td>{{$user->sponsor_id}}</td>
                                    <td>{{$user->position}}</td>
                                    <td>{{$user->pin_unique_value}}</td>
                                </tr>

                                @endforeach
                            </tbody>

                           </table>

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




