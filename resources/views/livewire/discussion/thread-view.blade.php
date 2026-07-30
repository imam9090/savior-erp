<div class="max-w-4xl mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <h2 class="text-lg font-semibold text-gray-800">{{ $discussion->title }}</h2>
    <p class="text-xs text-gray-500 mb-2">
        oleh {{ $discussion->user->name }} · {{ $discussion->created_at->diffForHumans() }}
    </p>
    <p class="text-sm text-gray-700 mb-6">{{ $discussion->body }}</p>

    <div class="space-y-3 mb-6">
        @forelse ($replies as $reply)
            <div class="border rounded-md p-3">
                <p class="text-sm text-gray-700">{{ $reply->body }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $reply->user->name }} · {{ $reply->created_at->diffForHumans() }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-400 text-center py-4">Belum ada balasan</p>
        @endforelse
    </div>

    <form wire:submit="addReply">
        <textarea wire:model="reply" placeholder="Tulis balasan..." rows="2" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2 mb-2"></textarea>
        @error('reply') <p class="text-xs text-red-600 mb-2">{{ $message }}</p> @enderror

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md">
            Kirim Balasan
        </button>
    </form>
</div>