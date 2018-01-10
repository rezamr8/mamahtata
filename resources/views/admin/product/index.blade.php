@extends('layouts.app')

@section('content')	
	<div class="container">
		<div class="col-md-9">
			<a href="/products/create" class="btn btn-primary">add Product</a>
	<hr>
	<table class="table table-responsive">
		<thead class="thead-light">
			<th class="col">#</th>
			<th class="col">nama</th>
			<th class="col">harga</th>
			<th class="col">created at</th>
			<th class="col">Action</th>
			
		</thead>

		<tbody>
			
		@foreach($products as $product)
		  <tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->nama }}</td>
			<td>{{ $product->harga }}</td>
			<td>{{ $product->created_at->toFormattedDateString() }}</td>
			<td> <a href="/products/{{ $product->id }}" class="btn btn-info">edit</a></td>
		 </tr>
		@endforeach
			
		</tbody>
	</table>
		</div>
	</div>
	

@endsection