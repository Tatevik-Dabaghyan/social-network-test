<h1>Profile posts</h1>
@if (count($posts) > 0)
    @foreach($posts as $post)
        <div class="post">
            <p>Post ID: {{$post->id}}</p>
            <p>User ID: {{$post->user_id}}</p>
            <p>User text: {{$post->text}}</p>
            <p>Post created_at: {{$post->created_at}}</p>
            <p>Post updated_at: {{$post->updated_at}}</p>
            <p>Post deleted_at: {{$post->deleted_at}}</p>

            @foreach($post->media as $media)
                @if(isset($media->source))
                    <p>Media source: {{ $media->source }}</p>
                    <p>Media type: {{ $media->type }}</p>
                    <img src="{{ $media->source }}" alt="">
                @endif
            @endforeach

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
@endif


