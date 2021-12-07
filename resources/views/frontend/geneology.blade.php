@extends('layouts.app.main')

@section('title', 'Geneology')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">

<style>

#chart-container {

  font-family: Arial;

  height: 420px;

  border: 2px dashed #aaa;

  border-radius: 5px;

  overflow: auto;

  text-align: center;

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

                    <li class="breadcrumb-item active" aria-current="page">Geneology</li>

                </ol>

            </nav>

            <!-- /Breadcrumb -->



            <!-- Container -->

            <div class="container">

                <!-- Title -->

                <div class="hk-pg-header">

                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="zap"></i></span></span>My Geneology</h4>

                </div>

                <!-- /Title -->

                <!-- Row -->

                <div class="row">

                    <div class="col-md-12">

                        <section class="hk-sec-wrapper">

                            <div class="col-lg-12">

                                <div class="card card-profile-feed">

                                    <div class="card-body">

                                        <div class="row">

                                            <form class="form-inline" method="get" action="">

                                                <div class="form-group mx-sm-3 mb-2">

                                                    <input type="text" name="username" id="username" class="form-control" aria-describedby="usernameHelpBlock" placeholder="Looking for someone?">

                                                </div>

                                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>

                                                {{--

                                                    <small id="usernameHelpBlock" class="form-text text-muted">Enter the username of your downline you are looking. If you don't get any feedback, then the user is not your downline</small> --}}

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="box box-default">

                                <div class="box-body">

                                    <div class="col-md-12">

                                        <div id="chart-container"></div>

                                    </div>

                                </div>

                            </div>

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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>

    <script>

        "use strict";



        (function($) {

            $(function() {



                var ajaxURLs = {

                    children: "/orgchart/children/",

                };



                var oc = $("#chart-container").orgchart({

                    data: "/orgchart/init/@if(!empty($_GET["username"])){{$_GET["username"]}}@endif",

                    ajaxURL: ajaxURLs,

                    nodeContent: "title",

                    nodeId: "id"

                });

            });

        })(jQuery);



    </script>



@endsection

