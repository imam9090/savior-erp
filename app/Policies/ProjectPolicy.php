<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        // Admin & Owner bisa lihat semua
        if (in_array($user->role->value, ['admin', 'superadmin'])) {
            return true;
        }

        // Customer cuma boleh lihat proyek miliknya sendiri
        if ($user->role->value === 'customer') {
            return $project->client_id === $user->id;
        }

        // Staff cuma boleh lihat proyek yang dia jadi member-nya
        return $project->members()->where('user_id', $user->id)->exists();
    }
    
}