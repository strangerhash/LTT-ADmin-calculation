@extends('layouts.app.main')

@section('title', 'Matrix Geneology Tree')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">

<style>



.orgchart {

    background-image: none !important;

}

.orgchart .verticalNodes>td::before{content:'';border:1px solid rgb(3, 155, 229)}

.orgchart .verticalNodes ul>li::before{box-sizing:border-box;content:'';position:absolute;left:-6px;border-color:rgb(3, 155, 229);border-style:solid;border-width:0 0 2px 2px}

.orgchart .lines .topLine{border-top:2px solid rgb(3, 155, 229)}

.orgchart .lines .rightLine{border-right:1px solid rgb(3, 155, 229);float:none;border-radius:0}

.orgchart .lines .leftLine{border-left:1px solid rgb(3, 155, 229);float:none;border-radius:0}

.orgchart .lines .downLine{background-color:rgb(3, 155, 229);margin:0 auto;height:20px;width:2px;float:none}

.orgchart .node .title{box-sizing:border-box;padding:2px;width:130px;text-align:center;font-size:.75rem;font-weight:700;height:20px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;background-color:rgb(3, 155, 229);color:#fff;border-radius:4px 4px 0 0}

.orgchart .node .content{box-sizing:border-box;padding:2px;height:20px;font-size:.625rem;border:1px solid rgb(3, 155, 229);border-radius:0 0 4px 4px;text-align:center;background-color:#fff;color:#333;text-overflow:ellipsis;white-space:nowrap}

ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 100px 0 0 100px
  /*padding: 0;*/
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}


.nested{
  margin-left : 30px;
}
.nested {
  /*display: none;*/
}

.active {
  display: block;
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

                @include('layouts.partials.error')

                {{-- /Include error --}}



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

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="box box-default">

                                <div class="box-body">

                                    <div class="col-md-12">

                                        <div id="chart-container">@php
                                         $html_output = ltrim($html,'"');
                                         $html_output = rtrim($html,'"');
                                         echo $html_output;
                                         @endphp</div>
                                        

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



@section('scripts')
<script>
        var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
    </script>

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>

    <script>

        "use strict";



        (function($) {

            $(function() {



                var ajaxURLs = {

                    children: "/orgchart/children/",

                };



                var oc = $("#chart-container").orgchart({

                    data: "/public/orgchart/init/@if(!empty($_GET["username"])){{$_GET["username"]}}@endif",

                    ajaxURL: ajaxURLs,

                    nodeContent: "title",

                    nodeId: "id"

                });

                alert('dfdd');

            });

        })(jQuery);



    </script> -->



@endsection

