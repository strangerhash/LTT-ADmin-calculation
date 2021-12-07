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

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Transactions</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('transactions.create') }}"> Create New Transaction</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

   

    <table class="table table-bordered">

        <tr>

            <th>ID</th>

            <th>User Name</th>

            <th>Wallet Type</th>

            <th>Amount</th>

            <th>Description</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($transactions as $transaction)

        <tr>

            <td>{{ $transaction->id }}</td>

            <td>{{ $transaction->user_id }}</td>

            <td>{{ $transaction->wallet_type }}</td>

            <td>{{ $transaction->amount }}</td>

            <td>{{ $transaction->description }}</td>

            <td>

            <form action="{{ route('transactions.delete',$transaction->id) }}" method="POST">
                        
                        <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>
                        @csrf
                        
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>


            
                

            </td>

        </tr>

        @endforeach

    </table>

  

   

      

   <!--  <div class="col-sm-12">

                    <form action="" method="POST">

                        <div class="form-group">

                    <label for="email">Wallet Type</label>

                   <select name="wallet_type" class="form-control">

                       <option value="">Select Wallet Type</option>

                       <option value="e-wallet">E-Wallet</option>

                   </select>

                 </div>

  <div class="form-group">

    <label for="pwd">Username:</label>

    <input type="text" class="form-control" name="user_name" id="user_name"/>

  </div>

  <div class="form-group">

    <label for="pwd">Amount:(N)</label>

    <input type="text" class="form-control" name="amount" id="amount"/>

  </div>



  <div class="form-group">

    <label for="pwd">Description</label>

    <textarea class="form-control" name="description" id="description"></textarea>

  </div>



  <button type="submit" class="btn btn-default">Submit</button>

                    </form>

 

                

            </div> -->





            



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

