<div class="max-w-4xl mx-auto mt-6 space-y-4">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">Kelola User</h2>
            <p class="text-sm text-slate-400 mt-0.5">Daftar akun dan hak akses pengguna sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="inline-flex items-center gap-1.5 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-colors shadow-sm shadow-indigo-200">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl p-3.5 flex items-center gap-2">
            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-rose-50 text-rose-700 text-sm rounded-xl p-3.5 flex items-center gap-2">
            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 bg-slate-50/60">
                    <th class="py-3 px-5 font-medium">Nama</th>
                    <th class="py-3 px-5 font-medium">Email</th>
                    <th class="py-3 px-5 font-medium">Role</th>
                    <th class="py-3 px-5 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($users as $user)
                    @php
                        $roleStyle = match ($user->role->value) {
                            'admin' => 'bg-indigo-50 text-indigo-600',
                            'superadmin' => 'bg-violet-50 text-violet-600',
                            'staff' => 'bg-blue-50 text-blue-600',
                            default => 'bg-slate-100 text-slate-500',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 px-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="text-slate-700 font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-5 text-slate-500">{{ $user->email }}</td>
                        <td class="py-3.5 px-5">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium capitalize {{ $roleStyle }}">
                                {{ $user->role->label() }}
                            </span>
                        </td>
                       <td class="py-3.5 px-5 text-right">
    <button
        x-data
        @click="if (confirm('Hapus user {{ $user->name }}?')) { $wire.delete({{ $user->id }}) }"
        class="inline-flex items-center gap-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
        Hapus
    </button>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <svg class="h-10 w-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            <p class="text-slate-400 text-sm">Belum ada user</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($users->hasPages())
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-3">
            {{ $users->links() }}
        </div>
    @endif
</div>