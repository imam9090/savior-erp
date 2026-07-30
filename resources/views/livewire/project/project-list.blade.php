<div class="max-w-4xl mx-auto mt-6">
    <div class="flex justify-between items-end mb-4">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">Proyek</h2>
            <p class="text-sm text-slate-400 mt-0.5">Daftar proyek yang bisa kamu akses</p>
        </div>
        @if (in_array(auth()->user()->role->value, ['superadmin', 'admin_client']))
            <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-1.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-colors shadow-sm shadow-orange-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Buat Proyek
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl p-3.5 mb-4">{{ session('success') }}</div>
    @endif

    <div class="space-y-3">
        @forelse ($projects as $project)
            <a href="{{ route('forum.show', $project) }}" class="block bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-5 hover:border-orange-200 transition-colors">
                <p class="font-medium text-slate-800">{{ $project->name }}</p>
                <p class="text-sm text-slate-500 mt-1">{{ $project->description }}</p>
                <p class="text-xs text-slate-400 mt-2">Klien: {{ $project->client->name }}</p>
            </a>
        @empty
            <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-10 text-center">
                <p class="text-slate-400 text-sm">Belum ada proyek</p>
            </div>
        @endforelse
    </div>
</div>