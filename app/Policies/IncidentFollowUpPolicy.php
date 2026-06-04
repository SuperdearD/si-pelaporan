<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IncidentFollowUp;
use Illuminate\Auth\Access\Response;

class IncidentFollowUpPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Incident Follow Up');
    }

    public function view(User $user, IncidentFollowUp $model): bool
    {
        return $user->can('View Incident Follow Up');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Incident Follow Up');
    }

    public function update(User $user, IncidentFollowUp $model): bool
    {
        return $user->can('Update Incident Follow Up');
    }

    public function delete(User $user, IncidentFollowUp $model): bool
    {
        return $user->can('Delete Incident Follow Up');
    }

    public function restore(User $user, IncidentFollowUp $model): bool
    {
        return $user->can('Restore Incident Follow Up');
    }

    public function forceDelete(User $user, IncidentFollowUp $model): bool
    {
        return $user->can('Force Delete Incident Follow Up');
    }
}