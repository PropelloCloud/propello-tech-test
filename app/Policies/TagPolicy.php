<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class TagPolicy
{
    public function view(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    public function update(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    public function delete(User $user, Tag $tag): Response
    {
        return $this->canAccess($user, $tag);
    }

    private function canAccess(User $user, Tag $tag): Response
    {
        return $user->id === $tag->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
