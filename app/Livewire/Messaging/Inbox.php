<?php

namespace App\Livewire\Messaging;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inbox extends Component
{
    public string $search = '';

    public function render()
    {
        $user = Auth::user();

        $query = User::where('id', '!=', $user->id);

        if ($user->role->value === 'client') {
            $query->where('role', '!=', 'client');
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $contacts = $query->get()->map(function ($contact) use ($user) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->count();

            $lastMessage = Message::where(function ($q) use ($user, $contact) {
                    $q->where('sender_id', $user->id)->where('receiver_id', $contact->id);
                })
                ->orWhere(function ($q) use ($user, $contact) {
                    $q->where('sender_id', $contact->id)->where('receiver_id', $user->id);
                })
                ->latest()
                ->first();

            $contact->last_message = $lastMessage?->body;
            $contact->last_message_time = $lastMessage?->created_at;

            return $contact;
        })->sortByDesc(fn ($c) => $c->last_message_time)->values();

        return view('livewire.messaging.inbox', [
            'contacts' => $contacts,
        ]);
    }
}