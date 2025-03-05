<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;


class TagController extends Controller
{
    public function index(): View
    {
        $tags = auth()->user()->tags;

        return view('tags.index', compact('tags'));
    }
    public function create(): View
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request): RedirectResponse
    {
        Tag::create([
            'name' => $request->validated()['name'],
            'user_id' => auth()->id()
        ]);

        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag): View
    {
        $this->authorize('update', $tag);

        return view('tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $this->authorize('update', $tag);

        $tag->update([
            'name' => $request->validated()['name'],
        ]);

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize('delete, $tag');
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
