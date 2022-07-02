@extends('layouts.app')

@section('content')
    @include('partials.posts.create')
    @include('partials.posts.index')

    @if(isset($post))
        @include('partials.posts.edit')
    @endif
@endsection
