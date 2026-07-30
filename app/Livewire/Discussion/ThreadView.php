<?php

namespace App\Livewire\Discussion;

use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ThreadView extends Component
{
    public Discussion $discussion;

    public string $reply = '';

    public function mount(Discussion $discussion): void
    {
        $this->discussion = $discussion;
    }

    public function addReply(): void
    {
        $this->validate([
            'reply' => 'required|min:2',
        ]);

        $this->discussion->replies()->create([
            'user_id' => Auth::id(),
            'body' => $this->reply,
        ]);

        $this->reset('reply');
    }

    public function render()
    {
        return view('livewire.discussion.thread-view', [
            'replies' => $this->discussion->replies()->with('user')->oldest()->get(),
        ]);
    }
}