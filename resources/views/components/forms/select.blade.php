@props([
    'disabled' => false,
    'tags' => []
])

<select class="rounded" name="attach_tag">
    <option value="none">-- Select a Tag to attach --</option>
    @if($tags->isNotEmpty())
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    @endif
</select>
