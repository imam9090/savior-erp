<div class="max-w-4xl mx-auto mt-6">
    <div class="mb-4">
        <h2 class="text-xl font-semibold text-slate-800">Pesan</h2>
        <p class="text-sm text-slate-400 mt-0.5">Komunikasi dengan tim dan klien</p>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl p-3.5 mb-4">{{ session('success') }}</div>
    @endif

    <div class="relative mb-4">
        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Cari kontak..."
            class="w-full bg-white border border-slate-200 rounded-xl text-sm pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-orange-400"
        >
    </div>

    <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl overflow-hidden">
        <div class="divide-y divide-slate-50" wire:poll.10s>
            @forelse ($contacts as $contact)
                @php
                    $roleStyle = match ($contact->role->value) {
                        'superadmin' => 'bg-orange-100 text-orange-600',
                        'admin_client' => 'bg-violet-100 text-violet-600',
                        'admin_finance' => 'bg-blue-100 text-blue-600',
                        default => 'bg-slate-100 text-slate-500',
                    };
                @endphp
                <a href="{{ route('messages.show', $contact) }}" class="flex items-center justify-between gap-3 px-5 py-4 hover:bg-slate-50/70 transition-colors group">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-full {{ $roleStyle }} flex items-center justify-center text-sm font-semibold flex-shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-slate-800 truncate">{{ $contact->name }}</p>
                                <span class="text-xs text-slate-300">&middot;</span>
                                <p class="text-xs text-slate-400 flex-shrink-0">{{ $contact->role->label() }}</p>
                            </div>
                            <p class="text-xs text-slate-400 truncate max-w-xs">
                                {{ $contact->last_message ?? 'Belum ada percakapan' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                        @if ($contact->last_message_time)
                            <span class="text-xs text-slate-300">{{ $contact->last_message_time->diffForHumans(null, true) }}</span>
                        @endif
                        @if ($contact->unread_count > 0)
                            <span class="bg-orange-500 text-white text-xs font-semibold rounded-full px-2 py-0.5 min-w-[20px] text-center">
                                {{ $contact->unread_count > 99 ? '99+' : $contact->unread_count }}
                            </span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="py-14 text-center">
                    <svg class="h-10 w-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    <p class="text-slate-400 text-sm">Tidak ada kontak ditemukan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>