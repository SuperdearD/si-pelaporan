<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IncidentCause;
use Illuminate\Auth\Access\Response;

class IncidentCausePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Incident Cause');
    }

    public function view(User $user, IncidentCause $model): bool
    {
        return $user->can('View Incident Cause');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Incident Cause');
    }

    public function update(User $user, IncidentCause $model): bool
    {
        return $user->can('Update Incident Cause');
    }

    public function delete(User $user, IncidentCause $model): bool
    {
        return $user->can('Delete Incident Cause');
    }

    public function restore(User $user, IncidentCause $model): bool
    {
        return $user->can('Restore Incident Cause');
    }

    public function forceDelete(User $user, IncidentCause $model): bool
    {
        return $user->can('Force Delete Incident Cause');
    }
}