@extends('administrator.layouts.app-master')
@section('content')
<div class="main-content">
 <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <div class="page-title-box">

                        <h4 class="font-size-18">Members</h4>

                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item"><a href="javascript: void(0);">Members</a></li>

                            <li class="breadcrumb-item active">Members</li>

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

                    <form action="{{route('members.update',$user->id)}}" method="POST">
                     @csrf
                  <div class="form-group">

                    <label for="pwd">Name</label>

                    <input type="text" class="form-control" value="{{ $user->name}}" name="name" id="name" required="required" />

                  </div>

                  <div class="form-group">

                    <label for="pwd">First Name</label>

                    <input type="text" class="form-control" value="{{ $user->fname}}" name="fname" id="fname" required="required" />

                  </div>

                  <div class="form-group">

                    <label for="pwd">Last Name</label>

                    <input type="text" class="form-control" value="{{ $user->lname}}" name="lname" id="lname" required="required" />

                  </div>

                  <div class="form-group">

                    <label for="pwd">Sponsor ID</label>

                    <input type="text" class="form-control" value="{{ $user->sponsor_id}}" name="sponsor_id" id="sponsor_id" required="required" />

                  </div>

                  <div class="form-group">

                    <label for="pwd">Phone</label>

                    <input type="text" class="form-control" value="{{ $user->phone}}" name="phone" id="phone" required="required" />

                  </div>

                  <div class="form-group">

                    <label for="pwd">Account Name</label>

                    <input type="text" class="form-control" value="{{ $user->account_name}}" name="account_name" id="account_name" required="required" />

                  </div>

                        

          <button type="submit" class="btn btn-primary">Update</button>

                              </form>

          </div>

        </div> <!-- container-fluid -->

    </div>

    <!-- End Page-content -->
    @include('administrator.layouts.app-footer')
</div>

@endsection
@section('scripts')
@endsection