@props([
    'task'  => null,
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 flex items-center {{ $task?->complete ? 'line-through' : '' }}">{{ $task?->name }}</div>
    <div class="w-2/12 flex items-center">{{ $task?->created_at->format('jS M Y') }}</div>
    <div class="w-5/12 flex flex-wrap">
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.complete', ['task' => $task]) }}">
            {{ $task?->complete ? 'Pending' :  'Complete' }}
        </x-elements.link-button>
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.edit', ['task' => $task]) }}">
            Edit
        </x-elements.link-button>
        {{--    When the View Tags button is clicked, the Tags Modal component will be opened
                and the task and tags data will be passed to it--}}
        <x-elements.link-button class="mr-2 my-1 w-[110px]" href="#"
            @click="$refs.tagsModal.openModal({{ json_encode($task) }}, {{json_encode($task->tags)}})">
            View Tags
        </x-elements.link-button>
        <x-elements.link-button-danger class="mr-2 my-1 w-[110px]" href="{{ route('tasks.destroy', ['task' => $task]) }}">
            Delete
        </x-elements.link-button-danger>
    </div>
</div>
