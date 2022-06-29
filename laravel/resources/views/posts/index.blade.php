@extends('layouts.app')

@section('content')
    <h1>Profile posts</h1>
    <button>
        <a href="/profile/create">New post</a>
    </button>


    @if (count($posts) > 0)
    @foreach($posts as $post)
        <div class="post">
            <p>Post ID: {{$post->id}}</p>
            <p>User ID: {{$post->user_id}}</p>
            <p>User text: {{$post->text}}</p>
            <p>Post created_at: {{$post->created_at}}</p>
            <p>Post updated_at: {{$post->updated_at}}</p>
            <p>Post deleted_at: {{$post->deleted_at}}</p>

            <button>
                <a href="/profile/{{$post->id}}/edit">edit</a>
            </button>


            <form action="/profile/{{$post->id}}" method="post">
                @csrf
                @method('delete')

                <input type="submit" value="delete">
            </form>
        </div>
    @endforeach
    @else
        <p>No posts!</p>
    @endif

@endsection
