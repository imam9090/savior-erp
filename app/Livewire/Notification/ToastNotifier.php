<?php

namespace App\Livewire\Notification;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ToastNotifier extends Component
{
    public array $toasts = [];

    public function checkNewMessages(): void
    {
        $newMessages = Message::where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->whereNull('notified_at')
            ->with('sender')
            ->get();

        foreach ($newMessages as $message) {
            $this->toasts[] = [
                'id' => uniqid(),
                'sender_name' => $message->sender->name,
                'body' => $message->body,
            ];
        }

        if ($newMessages->isNotEmpty()) {
            Message::whereIn('id', $newMessages->pluck('id'))
                ->update(['notified_at' => now()]);
        }
    }

    public function dismiss(string $id): void
    {
        $this->toasts = array_values(array_filter(
            $this->toasts,
            fn ($toast) => $toast['id'] !== $id
        ));
    }

    public function render()
    {
        return view('livewire.notification.toast-notifier');
    }
}