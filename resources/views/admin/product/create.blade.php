@extends('layouts.app')
@section('content')
<h1>
    Create Product
</h1>
<form action="/products" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nama">
            nama product
        </label>
        <input class="form-control" id="nama" name="nama" type="text">
        </input>
    </div>
    <div class="form-group">
        <label for="harga">
            harga
        </label>
        <input class="form-control" id="harga" name="harga" type="number">
        </input>
    </div>

    <div class="form-group">
        <label for="stok">stok</label>
        <input class="form-control" type="number" id="stok" name="stok">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            submit
        </button>
    </div>

    @include('layouts.errors')
</form>

@endsection('content')
