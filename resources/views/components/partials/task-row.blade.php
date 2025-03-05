@props([
    'task'  => null,
])

<div class="w-full flex py-2 border-b border-gray-100 items-center">
    <div class="w-5/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">
        {{ $task?->name }}
    </div>

    <div class="w-2/12 flex items-center">
        {{ $task?->created_at->format('jS M Y') }}
    </div>

    <div class="w-6/12 flex items-center justify-start space-x-2">
        <x-elements.link-button class="w-[110px]" href="{{ route('tasks.complete', ['task' => $task]) }}">
            {{ $task?->complete ? 'Pending' : 'Complete' }}
        </x-elements.link-button>
        <x-elements.link-button class="w-[110px]" href="{{ route('tasks.edit', ['task' => $task]) }}">
            Edit
        </x-elements.link-button>
        <x-elements.link-button-danger class="w-[110px]" href="{{ route('tasks.destroy', ['task' => $task]) }}">
            Delete
        </x-elements.link-button-danger>
    </div>

    <div class="flex space-x-2">
        @if($task->tags->isNotEmpty())
            @foreach($task->tags as $tag)
                <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-full text-xs mr-2 mb-2">
                    {{ $tag->name }}
                </span>
            @endforeach
        @else
            <span class="text-gray-500 text-xs">No tags</span>
        @endif
    </div>
</div>
