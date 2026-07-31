<div class="max-w-4xl w-full mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-6xl p-6 mt-6">
    <h2 class="text-lg font-semibold text-slate-800 mb-4">Tambah Produk/Jasa</h2>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tipe</label>
                <select wire:model="type" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
                    <option value="jasa">Jasa</option>
                    <option value="barang">Barang</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Satuan</label>
                <input type="text" wire:model="unit" placeholder="Unit, Jam, Bulan, dll" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            </div>
        </div>

        <div>
    <label class="block text-sm text-gray-600 mb-1">Harga</label>
    <div
        x-data="{
            display: $wire.entangle('price').live ? new Intl.NumberFormat('id-ID').format($wire.price || 0) : ''
        }"
        x-init="display = $wire.price ? new Intl.NumberFormat('id-ID').format($wire.price) : ''"
    >
        <input
            type="text"
            inputmode="numeric"
            x-model="display"
            @input="
                let raw = $event.target.value.replace(/[^0-9]/g, '');
                $wire.set('price', raw ? parseInt(raw) : 0);
                display = raw ? new Intl.NumberFormat('id-ID').format(raw) : '';
            "
            placeholder="0"
            class="w-full border border-gray-300 rounded-md text-sm px-3 py-2"
        >
    </div>
    @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
</div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Deskripsi (opsional)</label>
            <textarea wire:model="description" rows="2" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2"></textarea>
        </div>

        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2.5 rounded-xl transition-colors">
            Simpan
        </button>
    </form>
</div>