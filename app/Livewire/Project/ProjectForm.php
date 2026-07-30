<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class ProjectForm extends Component
{
    public string $name = '';
    public string $description = '';
    public ?int $client_id = null;
    public array $selectedMembers = [];

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:3',
            'client_id' => 'required|exists:users,id',
        ]);

        $project = Project::create([
            'name' => $this->name,
            'description' => $this->description,
            'client_id' => $this->client_id,
        ]);

        if (! empty($this->selectedMembers)) {
            $project->members()->sync($this->selectedMembers);
        }

        session()->flash('success', 'Proyek berhasil dibuat.');

        $this->redirectRoute('projects.index');
    }

    public function render()
    {
        return view('livewire.project.project-form', [
            'clients' => User::where('role', 'client')->get(),
            'staffMembers' => User::whereIn('role', ['admin_client', 'admin_finance'])->get(),
        ]);
    }
}