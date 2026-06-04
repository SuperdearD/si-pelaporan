<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Accident;
use Illuminate\Auth\Access\Response;

class AccidentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Accident');
    }

    public function view(User $user, Accident $model): bool
    {
        return $user->can('View Accident');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Accident');
    }

    public function update(User $user, Accident $model): bool
    {
        return $user->can('Update Accident');
    }

    public function delete(User $user, Accident $model): bool
    {
        return $user->can('Delete Accident');
    }

    public function restore(User $user, Accident $model): bool
    {
        return $user->can('Restore Accident');
    }

    public function forceDelete(User $user, Accident $model): bool
    {
        return $user->can('Force Delete Accident');
    }
}