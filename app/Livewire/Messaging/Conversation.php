<?php

namespace App\Livewire\Messaging;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Conversation extends Component
{
    public User $contact;
    public string $body = '';

    public function mount(User $contact): void
{
    $this->contact = $contact;

    Message::where('sender_id', $contact->id)
        ->where('receiver_id', Auth::id())
        ->whereNull('read_at')
        ->update(['read_at' => now()]);
}

    public function getListenersProperty(): array
    {
        $ids = [Auth::id(), $this->contact->id];
        sort($ids);

        return [
            'echo-private:chat.' . implode('-', $ids) . ',.MessageSent' => 'onMessageReceived',
        ];
    }

    protected function getListeners(): array
    {
        return $this->listeners;
    }

    public function onMessageReceived(): void
    {
        // cukup trigger re-render, karena render() ambil ulang semua pesan dari DB
    }

   public function sendMessage(): void
{
    $this->validate([
        'body' => 'required|min:1',
    ]);

    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $this->contact->id,
        'body' => $this->body,
    ]);

    $this->reset('body');
}

public function deleteConversation(): void
{
    Message::where(function ($q) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $this->contact->id);
        })
        ->orWhere(function ($q) {
            $q->where('sender_id', $this->contact->id)
              ->where('receiver_id', Auth::id());
        })
        ->delete();

    session()->flash('success', 'Riwayat chat dengan ' . $this->contact->name . ' berhasil dihapus.');

    $this->redirectRoute('messages.inbox');
}

    public function render()
    {
        $messages = Message::where(function ($q) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->contact->id);
            })
            ->orWhere(function ($q) {
                $q->where('sender_id', $this->contact->id)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at')
            ->get();

        return view('livewire.messaging.conversation', [
            'messages' => $messages,
        ]);
    }
    
}