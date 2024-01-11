@if(@session()->has('fail'))
    <div class="container">
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    </div>
@endif
@if ($errors->any())
    <div class="container">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    </div>
@endif
