@extends('layouts.app')

@section('content')
    <h1>Create post</h1>

    <form action="/profile" method="post">
        @csrf

        <input type="text" name="text" >
        <input type="submit">
    </form>

@endsection
