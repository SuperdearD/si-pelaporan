<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FollowUpProgress;
use Illuminate\Auth\Access\Response;

class FollowUpProgressPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Follow Up Progress');
    }

    public function view(User $user, FollowUpProgress $model): bool
    {
        return $user->can('View Follow Up Progress');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Follow Up Progress');
    }

    public function update(User $user, FollowUpProgress $model): bool
    {
        return $user->can('Update Follow Up Progress');
    }

    public function delete(User $user, FollowUpProgress $model): bool
    {
        return $user->can('Delete Follow Up Progress');
    }

    public function restore(User $user, FollowUpProgress $model): bool
    {
        return $user->can('Restore Follow Up Progress');
    }

    public function forceDelete(User $user, FollowUpProgress $model): bool
    {
        return $user->can('Force Delete Follow Up Progress');
    }
}