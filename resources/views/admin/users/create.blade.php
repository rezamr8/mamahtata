@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">CreateUser</div>
	<div class="panel-body">
		<form action="{{ route('users.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">User</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="name">Email</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Add User</button>
			</div>
		</form>
	</div>
</div>
@stop