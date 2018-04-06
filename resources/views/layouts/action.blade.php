@hasrole('admin')
	<a href="/admin/orders/{{$id}}/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
	<a href="/admin/orders/{{$id}}" class="btn btn-xs btn-danger" id="delO" data-id="{{$id}}"><i class="fa fa-trash-o"></i> Del</a>
	<a href="/admin/orders/{{$id}}/bayar" class="btn btn-xs btn-info"><i class="fa fa-money"></i> Bayar</a>
@else
		@hasrole('setting')
			@if($piutang > 0)
			<a href="/admin/orders/{{$id}}/edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>
			@endif
		@else
		    @if($piutang > 0)
			<a href="/admin/orders/{{$id}}/bayar" class="btn btn-xs btn-info"><i class="fa fa-money"></i> Bayar</a>
			@else
				<i class="fa fa-check btn btn-info"></i>
			@endif
		@endhasrole

@endhasrole