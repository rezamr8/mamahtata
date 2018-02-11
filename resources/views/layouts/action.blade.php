@hasrole('admin')
	<a href="orders/{{$id}}/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
	<a href="orders/{{$id}}" class="btn btn-xs btn-danger" id="delO" data-id="{{$id}}"><i class="fa fa-trash-o"></i> Del</a>
	<a href="orders/{{$id}}/bayar" class="btn btn-xs btn-info"><i class="fa fa-money"></i> Bayar</a>
@else
		@hasrole('setting')
			<a href="orders/{{$id}}/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
		@else
			<a href="orders/{{$id}}/bayar" class="btn btn-xs btn-info"><i class="fa fa-money"></i> Bayar</a>
		@endhasrole

@endhasrole