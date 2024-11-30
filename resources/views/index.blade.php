@extends('layouts.app')

@section('content')
    <div class="tasks-section">
        <span class="mb-6 text-4xl inline-block">Tasks</span>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if ($tasks->isNotEmpty())
                    <div class="w-full flex pb-2 border-b border-gray-200">
                        <div class="w-5/12 font-semibold">Name</div>
                        <div class="w-2/12 font-semibold">Created At</div>
                        <div class="w-5/12 font-semibold">Actions</div>
                    </div>
                @endif
                {{--  Gave the tasks list a max height and enabled scrolling if more is added  --}}
                <div class="max-h-56 overflow-y-auto">
                    @foreach ($tasks as $task)
                        <x-partials.task-row :task="$task" />
                    @endforeach
                </div>

                <div class="w-full text-center pt-4">
                    <x-elements.link-button href="{{ route('tasks.create') }}">
                        Add Task
                    </x-elements.link-button>
                </div>
            </div>
        </div>
    </div>
    {{--  This is the section that displays the tags table  --}}
    <div class="tags-section mb-8">
        <span class="mb-6 text-4xl inline-block mt-10">Tags</span>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if ($tags->isNotEmpty())
                    <div class="w-full flex pb-2 border-b border-gray-200">
                        <div class="w-2/3 font-semibold">Name</div>
                        <div class="w-1/3 font-semibold">Created At</div>
                        <div class="w-1/3 font-semibold">Actions</div>
                    </div>
                @endif

                <div class="max-h-56 overflow-y-auto">
                    @foreach ($tags as $tag)
                        <x-partials.tag-row :tag="$tag" />
                    @endforeach
                </div>
                <div class="w-full text-center pt-4">
                    <x-elements.link-button href="{{ route('tags.create') }}">
                        Add Tag
                    </x-elements.link-button>
                </div>
            </div>
        </div>
    </div>

    {{--  The vue Modal component that displays the tags associated with a specific task  --}}
    <tags-modal ref="tagsModal"></tags-modal>

    {{--  Feedback Modal for a successful/failed submission  --}}
    <x-modals.modal :show="session('success') || session('error')">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">{{ session('success') ? 'Success!' : 'Error!' }}</h2>
            <p>{{ session('success') ?? session('error') }}</p>

            {{-- Close Button --}}
            <button id="closeModalBtn"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 float-right mb-4"
                @click="closeModal">
                Close
            </button>
        </div>
    </x-modals.modal>

    {{-- JavaScript to close the Feedback Modal --}}
    <script>
        // Wait for the DOM to fully load before attaching event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalBtn = document.getElementById('closeModalBtn');
            const modalElement = document.querySelector('#modal');
            // Check if close button exists before adding event listener
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    // Hide the modal
                    modalElement.style.display = "none"
                });
            }
        });
    </script>
@endsection
