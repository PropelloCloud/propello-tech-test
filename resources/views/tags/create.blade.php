<form method="POST" action="{{ route('tags.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Tag Name" required>
    <input type="hidden" name="task_id" value="{{ $task->id }}">
    <button type="submit">Create Tag</button>
</form>