<form method="POST" action="{{ route('tags.update', $tag->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $tag->name }}" required>
    <button type="submit">Update Tag</button>
</form>