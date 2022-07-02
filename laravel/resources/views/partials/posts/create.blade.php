<h1>Create post</h1>

<form action="/profile" method="post" enctype="multipart/form-data">
    @csrf

    <input type="text" name="text">
    <input type="file" name="media">
    <input type="submit" value="New post">
</form>
