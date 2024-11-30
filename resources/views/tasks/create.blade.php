@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="pb-4">
                    <x-forms.input-label for="name" :value="__('Name')" />
                    <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Tags Section -->
                <div class="pb-4 mt-6">
                    <x-forms.input-label for="tags" :value="__('Tags')" />
                    <div class="space-y-2 mt-4 max-h-24 overflow-y-auto">
                        @foreach ($tags as $tag)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="tag_{{ $tag->id }}" name="tag_ids[]"
                                    value="{{ $tag->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="tag_{{ $tag->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-forms.input-error :messages="$errors->get('tag_ids')" class="mt-2" />
                </div>

                <x-elements.primary-button>
                    Create
                </x-elements.primary-button>
            </form>
        </div>
    </div>
@endsection
