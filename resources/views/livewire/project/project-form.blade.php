<div class="max-w-md mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Buat Proyek Baru</h2>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Proyek</label>
            <input type="text" wire:model="name" placeholder="misal: Konsultasi Pajak PT Contoh" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi</label>
            <textarea wire:model="description" rows="3" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2"></textarea>
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Klien</label>
            <select wire:model="client_id" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
                <option value="">-- Pilih Klien --</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-2">Anggota Tim (opsional)</label>
            <div class="space-y-2">
                @foreach ($staffMembers as $member)
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" wire:model="selectedMembers" value="{{ $member->id }}" class="rounded border-gray-300">
                        {{ $member->name }} ({{ $member->role->label() }})
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-xl transition-colors">
            Simpan
        </button>
    </form>
</div>