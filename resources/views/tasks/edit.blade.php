@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form method="POST" action="{{ route('tasks.update', ['task' =>  $task]) }}">
            @csrf
            @method('PUT')

            <div class="pb-4">
                <x-forms.input-label for="name" :value="__('Name')" />
                <x-forms.text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$task->name" required autofocus />
                <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <x-elements.primary-button>
                Update
            </x-elements.primary-button>
        </form>
    </div>
</div>
@endsection