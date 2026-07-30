<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6 mt-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Buat Invoice Baru</h2>

    <form wire:submit="save" class="space-y-4">
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

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal Invoice</label>
                <input type="date" wire:model="issue_date" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jatuh Tempo</label>
                <input type="date" wire:model="due_date" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-gray-600 mb-1">PPN (%)</label>
                <input type="number" step="0.01" wire:model.live="ppn_rate" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">PPh (%)</label>
                <input type="number" step="0.01" wire:model.live="pph_rate" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-2">Rincian Item</label>

            <div class="flex gap-2 mb-1 text-xs text-gray-500">
                <span class="flex-1">Deskripsi</span>
                <span class="w-20">Satuan</span>
                <span class="w-16">Qty</span>
                <span class="w-32">Harga Satuan</span>
                <span class="w-12"></span>
            </div>

            <div class="space-y-2">
    @foreach ($items as $index => $item)
        <div class="border border-gray-200 rounded-md p-3 space-y-2">
            <select
                wire:model="items.{{ $index }}.product_id"
                wire:change="selectProduct({{ $index }})"
                class="w-full border border-gray-300 rounded-md text-sm px-2 py-2"
            >
                <option value="">-- Pilih dari Produk/Jasa (opsional) --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ ucfirst($product->type) }}) - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                @endforeach
            </select>

            <div class="flex gap-2 items-start">
                <div class="flex-1">
                    <input type="text" wire:model.live="items.{{ $index }}.description" placeholder="Deskripsi jasa/produk" class="w-full border border-gray-300 rounded-md text-sm px-2 py-2">
                    @error("items.{$index}.description") <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <input type="text" wire:model.live="items.{{ $index }}.unit" placeholder="Unit" class="w-20 border border-gray-300 rounded-md text-sm px-2 py-2">
                <input type="number" step="0.01" wire:model.live="items.{{ $index }}.quantity" placeholder="Qty" class="w-16 border border-gray-300 rounded-md text-sm px-2 py-2">

                <div
                    class="w-32"
                    x-data="{
                        raw: @entangle('items.' . $index . '.unit_price'),
                        get formatted() {
                            if (!this.raw) return '';
                            return new Intl.NumberFormat('id-ID').format(this.raw);
                        },
                        updateRaw(value) {
                            this.raw = value.replace(/[^0-9]/g, '');
                        }
                    }"
                >
                    <input
                        type="text"
                        inputmode="numeric"
                        placeholder="Harga satuan"
                        x-bind:value="formatted"
                        @input="updateRaw($event.target.value)"
                        class="w-32 border border-gray-300 rounded-md text-sm px-2 py-2"
                    >
                </div>

                <div class="w-12 flex justify-center">
                    @if (count($items) > 1)
                        <button type="button" wire:click="removeItem({{ $index }})" class="text-red-600 text-sm">Hapus</button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
            <button type="button" wire:click="addItem" class="mt-2 text-sm text-blue-600 hover:underline">+ Tambah item</button>
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Terms & Notes</label>
            <textarea wire:model="notes" rows="3" class="w-full border border-gray-300 rounded-md text-sm px-3 py-2"></textarea>
        </div>

        <div class="border-t pt-4 space-y-1 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Subtotal</span>
                <span>Rp {{ number_format($this->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">PPN ({{ $ppn_rate }}%)</span>
                <span class="text-emerald-600">+ Rp {{ number_format($this->ppnAmount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">PPh ({{ $pph_rate }}%)</span>
                <span class="text-rose-600">- Rp {{ number_format($this->pphAmount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-semibold text-base">
                <span>Total</span>
                <span>Rp {{ number_format($this->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-md">
            Simpan Invoice
        </button>
    </form>
</div>