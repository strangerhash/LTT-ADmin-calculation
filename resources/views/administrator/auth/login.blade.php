@extends('administrator.layouts.auth-master')

@section('content')
<div class="card overflow-hidden">
    <div class="bg-primary">
        <div class="text-primary text-center p-4">
            <h5 class="text-white font-size-20">Iscube Admin</h5>
        </div>
    </div>

    <div class="card-body p-2">
        <div class="p-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form class="form-horizontal mt-2 2" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control"  id="username" placeholder="Enter username">
                </div>

                <div class="form-group">
                    <label for="userpassword">Password</label>
                    <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password">
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        {{-- <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                            <label class="custom-control-label" for="customControlInline">Remember me</label>
                        </div> --}}
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
