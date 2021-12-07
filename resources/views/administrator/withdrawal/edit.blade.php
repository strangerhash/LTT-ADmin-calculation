@extends('administrator.layouts.app-master')
@section('content')
<div class="main-content">
 <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <div class="page-title-box">

                        <h4 class="font-size-18">Withdrawal</h4>

                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item"><a href="javascript: void(0);">Withdrawal</a></li>

                            <li class="breadcrumb-item active">Withdrawal Request</li>

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

                    <form action="{{route('withdrawal.update',$withdrawal->id)}}" method="POST">
                     @csrf
                  <div class="form-group">

                    <label for="pwd">Amount:(N)</label>

                    <input type="text" class="form-control" value="{{ $withdrawal->amount}}" name="amount" id="amount" required="required" />

                  </div>

                        <!-- <div class="form-group">

                    <label for="email">Payment Method</label>

                   <select name="payment_method" class="form-control" required="required">

                       <option value="">Select Payment method</option>

                       <option value="e-wallet" {{ ($withdrawal->payment_method) == 'e-wallet' ? 'selected' : '' }}>e-wallet</option>
                       <option value="other" {{ ($withdrawal->payment_method) == 'other' ? 'selected' : '' }}>other</option>
                   </select>

                 </div> -->

              <div class="form-group">

                <label for="pwd">Depositor Name:</label>
                <select name="user_id" class="form-control" required="required">
                  <option value="">Select Depositor Name</option>
                 @foreach ($users as $user)
                 <option value="{{$user->id}}" {{ ($withdrawal->user_id) == $user->id ? 'selected' : '' }}> {{$user->name}} </option>

                 @endforeach
                </select>
              </div>

            <div class="form-group">

                <label for="email">Payment Status</label>

                    <select name="status" class="form-control" required="required">

                     <option value="1" {{ ($withdrawal->status) == '1' ? 'selected' : '' }}>Approve</option>
                    <option value="0" {{ ($withdrawal->status) == '0' ? 'selected' : '' }}>Decline</option>
                  </select>

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