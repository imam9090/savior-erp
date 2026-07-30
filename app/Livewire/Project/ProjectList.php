<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectList extends Component
{
    public function render()
    {
        $user = Auth::user();

        $query = Project::query();

        if ($user->role->value === 'customer') {
            $query->where('client_id', $user->id);
        } elseif ($user->role->value === 'staff') {
            $query->whereHas('members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        // admin & owner lihat semua, tanpa filter tambahan

        return view('livewire.project.project-list', [
            'projects' => $query->with('client')->get(),
        ]);
    }
}