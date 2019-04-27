@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong>
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ (is_array($error)?var_export($error,true):$error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(request()->session()->has('info'))
    <div class="alert alert-info">
        <p>{{ session('info') }}<p>
    </div>
@endif
