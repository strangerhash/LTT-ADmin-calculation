@extends('administrator.layouts.app-master')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18">Withdrawal Request</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Financial</a></li>
                            <li class="breadcrumb-item active">Withdrawal Request</li>
                        
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
                
                <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Withdrawal Request</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('withdrawal.create')}}">Create Withdrawal Request</a>
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
            <th>User</th>
            <th>Status</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($withdrawal as $with)

        <tr>

            <td>{{ $with->amount }}</td>

            <td>{{ $with->name }}</td>

            <td>{{ ($with->status) == '1' ? 'Approve' : 'Decline' }}</td>

            <td>{{ $with->date_created }}</td>

            <td>

            <form action="{{ route('withdrawal.delete',$with->id) }}" method="POST">
                        
                        <a class="btn btn-primary" href="{{ route('withdrawal.edit',$with->id) }}">Edit</a>
                        @csrf
                        
                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-{{$with->id}}">
                    Status </button>
                    <!-- The Modal -->
                    <div class="modal" id="myModal-{{$with->id}}">
                    <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                    <h4 class="modal-title">Status</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                     <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ route('withdrawal.status',$with->id) }}" method="POST">
                            <div class="form-group">
                                     @csrf
                        <label for="email">Payment Status</label>

                        <select name="status" class="form-control" required="required">

                            <option value="1" {{ ($with->status) == '1' ? 'selected' : '' }}>Approve</option>
                            <option value="0" {{ ($with->status) == '0' ? 'selected' : '' }}>Decline</option>
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
