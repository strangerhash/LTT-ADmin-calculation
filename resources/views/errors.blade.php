@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <div class="alert alert-warning text-danger">
        NB: Please try to upgrade before your downlines. Failure to do this <strong>may result to loosing your sponsor's bonuses</strong> when they <em>(your downlines)</em> cycle.
    </div>
@endif
