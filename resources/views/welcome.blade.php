@extends('layouts.master')

@section('content')
       @foreach ($tasks as $task) 
            <a href="/tasks/{{$task->id}}">
                <li>{{ $task->title }}</li>
            </a>
       @endforeach
@endsection
