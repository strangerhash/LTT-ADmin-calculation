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
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Members</h2>
            </div>
            <div class="" id="ajax-alert" role="alert">
              
            </div>
            <div class="pull-right">
                <!-- <a class="btn btn-success" href="{{route('funddeposit.create')}}"> Create Fund Deposit</a> -->
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
            <th>Username</th>
            <th>First name</th>
            <th>Last name</th>
            <th>E-mail </th>
            <th>Sponsor's ID  </th>
            <th>Status </th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($users as $user)

        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>

            <td>{{ $user->fname }}</td>

            <td>{{ $user->lname }}</td>

            <td>{{ $user->email }}</td>
            <td>{{ $user->sponsor }}</td>
            <td>{{ ($user->status) == '1' ? 'Active' : 'Inactive' }}</td>
            <td>

            <form action="{{ route('members.changeStatus',$user->id) }}" method="POST">
                        
            <a class="btn btn-primary" href="{{ route('members.edit',$user->id) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('members.network',$user->id) }}">View Network</a>
            <a class="btn btn-primary" href="{{ route('user_transactions', $user->id) }}">View Transaction</a>
            <a data-id="{{$user->id}}" href="javascript:void(0)" onclick="showModal({{$user->id}})" class="btn btn-primary open-homeEvents">Change Password</a>
           
                @csrf

                @if($user->status == 1)
                <button type="submit" class="btn btn-danger">Delete</button>
                @endif

            </form>
                
            </td>

        </tr>

        @endforeach
        
    </table>

        {{ $users->links() }}
    
  
   

 <div class="modal fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" >&times;</span></button>

                  </div>
                  <div class="modal-body">
                        <input type="hidden" id="userID"/> <!-- The value is the id of the user whose password is about to be reset -->
                      <div class="pass_all">
                          <label>New Password</label>  
                          <input type="password" id="newPassword"/>
                      </div>
                      <div class="pass_all">
                          <label>Confirm Password</label>
                          <input type="password" id="confirmPassword"/>
                      </div>
                          
<!--                      <meta name="csrf-token" content="{{ csrf_token() }}">-->

            <!--            <button id="btnSubmit" value=""/>-->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSubmit">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            
            
<script type="text/javascript">
            
    $("#btnSubmit").click(function (e) {
        $.ajax({
           
            type: "POST",
            url: "members/password_change",
            data: {
                _token:"{{ csrf_token() }}",
                id: $("#userID").val(), // This could be a hidden field whit the value of user id
                new_password: $("#newPassword").val(),      
                confirm_password: $("#confirmPassword").val()

            },success: function(result){
                        $('#passModal').modal('hide');

//                console.log('Result', JSON.parse(result))
                parsedData = JSON.parse(result);
                if(parsedData){
                    if(parsedData.status == 100){
                       $("#ajax-alert").addClass("alert alert-success").text(parsedData.msg);
                        $("#ajax-alert").alert();
                        $("#ajax-alert").fadeTo(5000, 5000).slideUp(1000, function(){
                        });
                       }else{
                           $("#ajax-alert").addClass("alert alert-danger").text(parsedData.msg);
                        $("#ajax-alert").alert();
                        $("#ajax-alert").fadeTo(5000, 5000).slideUp(1000, function(){
                        });
                       }
                   }
            },error:function(err){
                        $('#passModal').modal('hide');

                $("#ajax-alert").addClass("alert alert-error").text("Something went wrong.");
                        $("#ajax-alert").alert();
                        $("#ajax-alert").fadeTo(5000, 5000).slideUp(1000, function(){
                        });
            }
        });

    });
    function showModal(userID){
        $("#userID").val( userID );
        $('#passModal').modal('show');
    }
    </script>
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
