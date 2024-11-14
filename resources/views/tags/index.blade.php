@extends('layouts.app')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if($tags->isNotEmpty())
                <div class="w-full flex pb-2 border-b border-gray-200">
                    <div class="w-5/12 font-semibold">Name</div>
                    <div class="w-2/12 font-semibold">Created At</div>
                    <div class="w-5/12 font-semibold">Actions</div>
                </div>
            @endif

            @foreach($tags as $tag)
                <x-partials.tag-row :tag="$tag" />
            @endforeach

            <div class="w-full text-center pt-4">
                <x-elements.link-button href="{{ route('tags.create') }}">
                    Add Tag
                </x-elements.link-button>
            </div>
        </div>
    </div>
@endsection
