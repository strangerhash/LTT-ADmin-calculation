@extends('administrator.layouts.app-master')



@section('content')


<div class="main-content">



    <div class="page-content">

        <div class="container-fluid">



            <!-- start page title -->

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <div class="page-title-box">

                        <h4 class="font-size-18">System</h4>

                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item"><a href="javascript: void(0);">Vital Variables</a></li>

                            <li class="breadcrumb-item active">Vital Variables</li>

                        </ol>

                    </div>

                </div>

            </div>

            <!-- end page title -->

            <div class="row">

                <!-- Alert message (start) -->

     <!-- Alert message (start) -->

     @if(Session::has('message'))

     <div class="alert {{ Session::get('alert-class') }}">

        {{ Session::get('message') }}

     </div>

     @endif 

                <div class="col-sm-12">

                    <form action="{{route('vitalvaribales.store')}}" method="POST">

                      {{csrf_field()}}

                       <div class="form-group">

                      <label for="pwd">Cost of Updgrade:</label>
                    <input type="text" name="cost_of_upgrade" class="form-control" required="required"/>
   
                    </div>

                    <div class="form-group">

                      <label for="pwd">Cost of LTT</label>

                      <input type="text" class="form-control" name="cost_of_ltt" id="cost_of_ltt" required="required" />

                    </div>


                    <div class="form-group">

                      <label for="pwd">Cost of SST</label>

                      <input type="text" class="form-control" name="cost_of_stt" id="cost_of_stt" required="required" />

                    </div>

                    <div class="form-group">

                      <label for="pwd">STT max purchase</label>

                      <input type="text" class="form-control" name="stt_max_purchase" id="stt_max_purchase" required="required" />

                    </div>

                    <div class="form-group">

                      <label for="pwd">LLT Overall Purchase</label>

                      <input type="text" class="form-control" name="ltt_overall_purchase" id="ltt_overall_purchase" required="required" />

                    </div>

                  
                    <div class="form-group">

                      <label for="pwd">Returns stt ltt</label>

                      <input type="text" class="form-control" name="returns_stt_ltt" id="returns_stt_ltt" required="required" />

                    </div>

                     <div class="form-group">

                      <label for="pwd">Duration of ltt stt</label>

                      <input type="text" class="form-control" name="duration_of_ltt_stt" id="duration_of_ltt_stt" required="required" />

                    </div>

                    <div class="form-group">

                      <label for="pwd">No of month withdraw ltt</label>

                      <input type="text" class="form-control" name="no_of_month_withdraw_ltt" id="no_of_month_withdraw_ltt" required="required" />

                    </div>

                    <div class="form-group">

                      <label for="pwd">Allow LTT purchase after completing Intro Quorum</label>

                      <select name="allow_ltt_purchase_completing" id="allow_ltt_purchase_completing" class="form-control">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                      </select>

                    </div>

                     <div class="form-group">

                      <label for="pwd">Enroll 3 upgraded users before allowed to by STT</label>

                      <select name="enroll_3upgraded_users" id="enroll_3upgraded_users" class="form-control">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                      </select>

                    </div>

                    <div class="form-group">

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

                    </form>

            </div>



        </div> <!-- container-fluid -->

    </div>

    <!-- End Page-content -->



    



    @include('administrator.layouts.app-footer')



</div>

@endsection



@section('scripts')

    <script>

        

    </script>

@endsection

