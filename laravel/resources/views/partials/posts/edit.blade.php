<h1>Edit post</h1>

<form action="/profile/{{ $post -> id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="text" value="{{$post->text}}">
    <input type="file" name="media">
    <input type="submit" value="Edit post">
</form>
