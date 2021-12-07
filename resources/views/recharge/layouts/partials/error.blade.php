@if(Session::has('message'))
<div class="alert alert-inv alert-inv-{{ Session::get('alert') }} text-center">
    {!! Session::get('message') !!}
</div>
@endif


@if ($errors->any())
<div class="container"><br>
    <div class="alert alert-inv alert-inv-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif


@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif


{{-- Sticky Message --}}
@if (App\Helpers::settings('recharge_sticky_message') != '')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {!! App\Helpers::settings('recharge_sticky_message') !!}
    </div>
@endif
