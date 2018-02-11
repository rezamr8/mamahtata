@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Produk {{ $produk->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/produk') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/produk/' . $produk->id . '/edit') }}" title="Edit Produk"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/produk' . '/' . $produk->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Produk" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $produk->id }}</td>
                                    </tr>
                                    <tr><th> Nama </th><td> {{ $produk->nama }} </td></tr><tr><th> Harga Beli </th><td> {{ $produk->harga_beli }} </td></tr><tr><th> Harga Jual </th><td> {{ $produk->harga_jual }} </td></tr><tr><th> Stok </th><td> {{ $produk->stok }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
