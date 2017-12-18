@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
	Users 		
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>user</th>
					<th>email</th>
					<th>Permission</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if($users->count() > 0)
				@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>
							@if($user->admin)
								<a href="{{ route('users.not_admin',['id'=>$user->id]) }}" class="btn btn-xs btn-danger">Remove Permission</a>
							@else
								<a href="{{ route('users.admin',['id'=>$user->id]) }}" class="btn btn-xs btn-success">Make Admin</a>
							@endif
						</td>
						<td>Delete</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="4" class="text-center"></td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

@stop
