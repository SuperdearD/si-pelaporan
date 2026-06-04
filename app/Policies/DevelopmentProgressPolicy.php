<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DevelopmentProgress;
use Illuminate\Auth\Access\Response;

class DevelopmentProgressPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Development Progress');
    }

    public function view(User $user, DevelopmentProgress $model): bool
    {
        return $user->can('View Development Progress');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Development Progress');
    }

    public function update(User $user, DevelopmentProgress $model): bool
    {
        return $user->can('Update Development Progress');
    }

    public function delete(User $user, DevelopmentProgress $model): bool
    {
        return $user->can('Delete Development Progress');
    }

    public function restore(User $user, DevelopmentProgress $model): bool
    {
        return $user->can('Restore Development Progress');
    }

    public function forceDelete(User $user, DevelopmentProgress $model): bool
    {
        return $user->can('Force Delete Development Progress');
    }
}