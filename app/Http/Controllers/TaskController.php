<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{

    public function create(): View
    {
        $tags = auth()->user()->tags;

        return view('tasks.create', compact('tags'));
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);
        $tags = auth()->user()->tags;

        return view('tasks.edit', compact('task','tags'));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        $task = Task::query()->create(
            array_merge(
                $request->safe()->only('name'),
                ['user_id' => auth()->user()->id]
            )
        );

        if($request->filled('tag_ids')){
            $tagIds = $request->input('tag_ids');
            if(is_array($tagIds)){
                $task->tags()->sync($tagIds);
            }
        } else {
            if ($task->tags->isNotEmpty()) {
                $task->tags()->detach();
            }
        }

        return redirect()->to(route('home'))->with('success', 'The task has successfully been created');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        if($request->filled('tag_ids')){
            $tagIds = $request->input('tag_ids');
            if(is_array($tagIds)){
                $task->tags()->sync($tagIds);
            }
        } else {
            if ($task->tags->isNotEmpty()) {
                $task->tags()->detach();
            }
        }

        return redirect()->to(route('home'))->with('success', 'The task has successfully been updated');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->to(route('home'))->with('success', 'The task has successfully been deleted');
    }

    public function removeTag(Task $task, Tag $tag)
    {
        $this->authorize('removeTag', [$task, $tag]);
        // Ensure the task has the tag
        if ($task->tags()->where('tags.id', $tag->id)->exists()) {
            // Remove the tag from the task
            $task->tags()->detach($tag->id);

            // Optionally, you can add a success message
            return response()->json(['success' => 'Tag removed successfully'], 200);
        }

        // If the tag is not associated with the task
        return response()->json(['error' => 'Tag not found for this task'], 404);
    }

    public function complete(Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->complete = !$task->complete;
        $task->save();

        return redirect()->to(route('home'));
    }
}
