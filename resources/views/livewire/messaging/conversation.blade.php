<div class="max-w-4xl mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Chat dengan {{ $contact->name }}</h2>
        <button
            x-data
            @click="if (confirm('Hapus semua riwayat chat dengan {{ $contact->name }}? Tindakan ini tidak bisa dibatalkan.')) { $wire.deleteConversation() }"
            class="text-red-600 hover:text-red-700 text-sm"
        >
            Hapus Chat
        </button>
    </div>

    <div class="space-y-2 mb-4 max-h-96 overflow-y-auto" wire:poll.5s>
        @foreach ($messages as $message)
            <div class="{{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                <span class="inline-block px-3 py-2 rounded-lg text-sm {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-800' }}">
                    {{ $message->body }}
                </span>
                <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->format('H:i') }}</p>
            </div>
        @endforeach
    </div>

    <form wire:submit="sendMessage" class="flex gap-2">
        <input
            type="text"
            wire:model="body"
            placeholder="Tulis pesan..."
            class="flex-1 border border-gray-300 rounded-md text-sm px-3 py-2"
        >
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md">
            Kirim
        </button>
    </form>
</div>