<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = auth()->user()?->tasks ?? [];
        $tags = auth()->user()?->tags ?? [];

        return view('index', compact('tasks', 'tags'));
    }

    public function create(): View
    {

        return view('tasks.create');
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function store(CreateTaskRequest $request): RedirectResponse
    {
        Task::query()->create(
            array_merge(
                $request->validated(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->to(route('tasks.home'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->to(route('tasks.home'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->to(route('tasks.home'));
    }

    public function complete(Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $task->complete = !$task->complete;
        $task->save();

        return redirect()->to(route('tasks.home'));
    }

    public function attach(Request $request, Task $task)
    {
        $tagId = request('attach_tag');

        $task->tags()->attach($tagId);

        return redirect()->to(route('tasks.home'));
    }

    public function detach(Task $task)
    {
        $tagId = request('tag');

        $task->tags()->detach($tagId);

        return redirect()->to(route('tasks.home'));
    }
}
