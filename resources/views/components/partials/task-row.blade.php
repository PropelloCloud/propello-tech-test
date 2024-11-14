@props([
    'task'  => null,
    'tags'  => null
])

<div class="w-full flex py-2 border-b border-gray-100">
    <div class="w-5/12 {{ $task?->complete ? 'line-through' : '' }}">
        <div class="w-full">{{ $task?->name }}</div>
        @if($task?->tags?->isNotEmpty())
            <div class="flex flex-wrap">
                @foreach($task->tags as $tag)
                    <div class="mr-2 my-1 bg-gray-200 rounded p-1 text-xs">{{ $tag->name }}</div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="w-2/12 flex">{{ $task?->created_at->format('jS M Y') }}</div>
    <div class="w-5/12">
        <div class="w-full flex flex-wrap">
            <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.complete', ['task' => $task]) }}">
                {{ $task?->complete ? 'Complete' :  'Pending' }}
            </x-elements.link-button>
            <x-elements.link-button class="mr-2 my-1 w-[110px]" href="{{ route('tasks.edit', ['task' => $task]) }}">
                Edit
            </x-elements.link-button>
            <x-elements.link-button-danger class="mr-2 my-1 w-[110px]" href="{{ route('tasks.destroy', ['task' => $task]) }}">
                Delete
            </x-elements.link-button-danger>
        </div>
        @if(!$task?->complete)
            <div class="w-full mt-4">
                <form method="POST" action="{{ route('tasks.attach', ['task' =>  $task]) }}" class="flex">
                    @csrf
                    <x-forms.select name="tag_id" class="w-1/2" :tags="$tags" />
                    <x-elements.primary-button class="ml-2">
                        Attach Tag
                    </x-elements.primary-button>
                </form>
            </div>
        @endif
    </div>
</div>
