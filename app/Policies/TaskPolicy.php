<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function view(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    public function update(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    public function delete(User $user, Task $task): Response
    {
        return $this->canAccess($user, $task);
    }

    public function removeTag(User $user, Task $task, Tag $tag){
        return $user->id === $task->user_id && $user->id === $tag->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    private function canAccess(User $user, Task $task): Response
    {
        return $user->id === $task->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
