@extends('administrator.layouts.app-master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18">Fund Deposit</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Fund Deposit</a></li>
                            <li class="breadcrumb-item active">Incoming Funds</li>
                        
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                
                <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Fund Deposit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('funddeposit.create')}}"> Create Fund Deposit</a>
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
            <th>Amount</th>
            <th>Depositor Name</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($funddeposit as $fund)

        <tr>

            <td>{{ $fund->amount }}</td>

            <td>{{ $fund->name }}</td>

            <td>{{ $fund->payment_method  }}</td>

            <td>{{ ($fund->status) == '1' ? 'Approve' : 'Decline' }}</td>

            <td>{{ $fund->date_created }}</td>

            <td>

            <form action="{{route('funddeposit.delete',$fund->id) }}" method="POST">
                        
                        <a class="btn btn-primary" href="{{ route('funddeposit.edit',$fund->id) }}">Edit</a>
                        @csrf
                        
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{$fund->id}}">
                    Status </button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal-{{$fund->id}}">
                    <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                    <h4 class="modal-title">Status</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                     <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('funddeposit.status',$fund->id) }}" method="POST">
                            <div class="form-group">
                                     @csrf
                        <label for="email">Payment Status</label>

                        <select name="status" class="form-control" required="required">

                            <option value="1" {{ ($fund->status) == '1' ? 'selected' : '' }}>Approve</option>
                            <option value="0" {{ ($fund->status) == '0' ? 'selected' : '' }}>Decline</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <input type="submit" name="status_change" value="Status" class="btn btn-primary"/>
                        </div>

                        </form>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>

            </td>

        </tr>

        @endforeach

    </table>

        
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
