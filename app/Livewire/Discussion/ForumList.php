<?php

namespace App\Livewire\Discussion;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForumList extends Component
{
    public Project $project;

    public string $title = '';
    public string $body = '';

    public function mount(Project $project): void
    {
        $this->authorize('view', $project);

        $this->project = $project;
    }

    public function createDiscussion(): void
    {
        $this->validate([
            'title' => 'required|min:3',
            'body' => 'required|min:5',
        ]);

        $this->project->discussions()->create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'body' => $this->body,
        ]);

        $this->reset(['title', 'body']);
    }

    public function render()
    {
        return view('livewire.discussion.forum-list', [
            'discussions' => $this->project->discussions()->with('user')->latest()->get(),
        ]);
    }
}