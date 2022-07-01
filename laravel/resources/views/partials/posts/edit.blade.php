@extends('layouts.app')

@section('content')
    <h1>Edit post</h1>

    <form action="/profile/{{ $post -> id }}" method="post">
        @csrf
        @method('PUT')

        <input type="text" name="text" value="{{$post->text}}">
        <input type="submit">
    </form>

@endsection
