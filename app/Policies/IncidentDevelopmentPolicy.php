<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IncidentDevelopment;
use Illuminate\Auth\Access\Response;

class IncidentDevelopmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Incident Development');
    }

    public function view(User $user, IncidentDevelopment $model): bool
    {
        return $user->can('View Incident Development');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Incident Development');
    }

    public function update(User $user, IncidentDevelopment $model): bool
    {
        return $user->can('Update Incident Development');
    }

    public function delete(User $user, IncidentDevelopment $model): bool
    {
        return $user->can('Delete Incident Development');
    }

    public function restore(User $user, IncidentDevelopment $model): bool
    {
        return $user->can('Restore Incident Development');
    }

    public function forceDelete(User $user, IncidentDevelopment $model): bool
    {
        return $user->can('Force Delete Incident Development');
    }
}