@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success text-center"> {{ session('success') }}</div>
@endif

@if (session('info'))
    <div class="alert alert-info text-center"> {{ session('info') }}</div>
@endif

@if (session('danger'))
    <div class="alert alert-danger text-center"> {{ session('danger') }}</div>
@endif

