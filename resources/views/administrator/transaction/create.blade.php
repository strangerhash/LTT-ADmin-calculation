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

                    <form action="{{route('transactions.store')}}" method="POST">

                      {{csrf_field()}}

                        <div class="form-group">

                    <label for="email">Wallet Type</label>

                   <select name="wallet_type" class="form-control" required="required">

                       <option value="">Select Wallet Type</option>

                       <option value="e-wallet">E-Wallet</option>

                   </select>

                 </div>

  <div class="form-group">

    <label for="pwd">Username:</label>
<!--    <input type="text" name="user_id" class="form-control" required="required"/>-->
     <select name="user_id" class="form-control" required="required">
      <option value="">Select User</option>
     @foreach ($users as $user)
     <option value="{{$user->id}}"> {{$user->name}} </option>

     @endforeach
    </select> 
  </div>

  <div class="form-group">

    <label for="pwd">Amount:(N)</label>

    <input type="text" class="form-control" name="amount" id="amount" required="required" />

  </div>



  <div class="form-group">

    <label for="pwd">Description</label>

    <textarea class="form-control" name="description" id="description" required="required"></textarea>

  </div>

<button type="submit" class="btn btn-primary">Submit</button>

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

