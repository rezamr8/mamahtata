@extends('layouts.bootstrap')

@section('content')
<h1>
    Show Product
</h1>
<form action="{{action('ProductController@update', $id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nama">
            nama product
        </label>
        <input class="form-control" id="nama" name="nama" type="text" value="{{$product->nama}}">
        </input>
    </div>
    <div class="form-group">
        <label for="">
            harga
        </label>
        <input class="form-control" id="harga" name="harga" type="number" value="{{$product->harga}}">
        </input>
    </div>
    <div class="form-group">
        <label for="stok">
            stok
        </label>
        <input class="form-control" id="stok" name="stok" type="number" value="{{$product->stok}}">
        </input>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            Update
        </button>
    </div>
    @include('layouts.errors')
</form>
@endsection
