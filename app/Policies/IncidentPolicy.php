<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Incident;
use Illuminate\Auth\Access\Response;

class IncidentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Incident');
    }

    public function view(User $user, Incident $model): bool
    {
        return $user->can('View Incident');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Incident');
    }

    public function update(User $user, Incident $model): bool
    {
        return $user->can('Update Incident');
    }

    public function delete(User $user, Incident $model): bool
    {
        return $user->can('Delete Incident');
    }

    public function restore(User $user, Incident $model): bool
    {
        return $user->can('Restore Incident');
    }

    public function forceDelete(User $user, Incident $model): bool
    {
        return $user->can('Force Delete Incident');
    }
}