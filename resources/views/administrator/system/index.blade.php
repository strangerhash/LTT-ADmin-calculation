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

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Vital Variables</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('vitalvaribales.create') }}"> Create New Vital Variables </a>

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

            <th>Cost of Upgrade</th>

            <th>Cost of LTT</th>

            <th>Cost of STT</th>

            <th>STT max purchase</th>
            <th>SLTT overall purchase </th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($vital_variables as $vital_variable)

        <tr>

            <td>{{ $vital_variable->id }}</td>

            <td>{{ $vital_variable->cost_of_upgrade }}</td>

            <td>{{ $vital_variable->cost_of_ltt }}</td>

            <td>{{ $vital_variable->cost_of_stt }}</td>

            <td>{{ $vital_variable->stt_max_purchase }}</td>
            <td>{{ $vital_variable->ltt_overall_purchase }}</td>

            <td>

            <form action="{{ route('vitalvaribales.delete',$vital_variable->id) }}" method="POST">
                        
                        <a class="btn btn-primary" href="{{ route('vitalvaribales.edit',$vital_variable->id) }}">Edit</a>
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

