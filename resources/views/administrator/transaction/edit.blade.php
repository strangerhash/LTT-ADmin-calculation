@extends('administrator.layouts.app-master')



@section('content')


<div class="main-content">
 <div class="page-content">

        <div class="container-fluid">



            <!-- start page title -->

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <div class="page-title-box">

                        <h4 class="font-size-18">Wallets</h4>

                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item"><a href="javascript: void(0);">Wallets</a></li>

                            <li class="breadcrumb-item active">Incoming Funds</li>

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

                    <form action="{{route('transactions.update',$transaction->id)}}" method="POST">
                     @csrf

                        <div class="form-group">

                    <label for="email">Wallet Type</label>

                   <select name="wallet_type" class="form-control" required="required">

                       <option value="">Select Wallet Type</option>

                       <option value="e-wallet" {{ ($transaction->wallet_type) == 'e-wallet' ? 'selected' : '' }}>{{ $transaction->wallet_type }}</option>

                   </select>

                 </div>

  <div class="form-group">

    <label for="pwd">Username:</label>

    <input type="text" name="user_id" value="{{ $transaction->user_id }}" class="form-control" required="required"/>
    <!--<select name="user_id" class="form-control" required="required">
      <option value="">Select User</option>
     @foreach ($users as $user)
     <option value="{{$user->id}}" {{ ($transaction->user_id) == $user->id ? 'selected' : '' }}> {{$user->name}} </option>

     @endforeach
    </select>-->
  </div>

  <div class="form-group">

    <label for="pwd">Amount:(N)</label>

    <input type="text" class="form-control" value="{{ $transaction->amount}}" name="amount" id="amount" required="required" />

  </div>



  <div class="form-group">

    <label for="pwd">Description</label>

    <textarea class="form-control" name="description" id="description" required="required">{{ $transaction->description}}</textarea>

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

