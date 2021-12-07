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
                
                
                <div class="col-sm-12">
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
