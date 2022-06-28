@extends('layouts.app')

@section('content')
    <h1>Home page</h1>

    @foreach($posts as $post)
        <p>{{ $post }}</p>
    @endforeach

@endsection
