<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DevelopmentReport;
use Illuminate\Auth\Access\Response;

class DevelopmentReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('View Any Development Report');
    }

    public function view(User $user, DevelopmentReport $model): bool
    {
        return $user->can('View Development Report');
    }

    public function create(User $user): bool
    {
        return $user->can('Create Development Report');
    }

    public function update(User $user, DevelopmentReport $model): bool
    {
        return $user->can('Update Development Report');
    }

    public function delete(User $user, DevelopmentReport $model): bool
    {
        return $user->can('Delete Development Report');
    }

    public function restore(User $user, DevelopmentReport $model): bool
    {
        return $user->can('Restore Development Report');
    }

    public function forceDelete(User $user, DevelopmentReport $model): bool
    {
        return $user->can('Force Delete Development Report');
    }
}