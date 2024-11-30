<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function create(): View
    {

        return view('tags.create');
    }

    public function edit(Tag $tag): View
    {
        $this->authorize('update', $tag);

        return view('tags.edit', compact('tag'));
    }

    public function store(CreateTagRequest $request): RedirectResponse
    {
        Tag::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->to(route('home'))->with('success', 'The tag has successfully been created');;
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $this->authorize('update', $tag);

        $tag->update($request->validated());

        return redirect()->to(route('home'))->with('success', 'The tag has successfully been updated');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->to(route('home'))->with('success', 'The tag has successfully been deleted');
    }
}
