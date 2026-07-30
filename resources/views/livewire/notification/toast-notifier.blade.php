<div class="fixed top-4 right-4 z-50 space-y-2" style="width: 320px;" wire:poll.5s="checkNewMessages">
    @foreach ($toasts as $toast)
        <div
            wire:key="{{ $toast['id'] }}"
            x-data="{ show: true }"
            x-init="setTimeout(() => { show = false; $wire.dismiss('{{ $toast['id'] }}') }, 5000)"
            x-show="show"
            x-transition
            class="bg-white border-l-4 border-blue-500 shadow-lg rounded-lg p-4"
        >
            <div class="flex justify-between items-start gap-3">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                        💬
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $toast['sender_name'] }}</p>
                        <p class="text-sm text-gray-600 mt-0.5">{{ $toast['body'] }}</p>
                    </div>
                </div>
                <button wire:click="dismiss('{{ $toast['id'] }}')" class="text-gray-400 hover:text-gray-600 text-sm flex-shrink-0">
                    ✕
                </button>
            </div>
        </div>
    @endforeach
</div>