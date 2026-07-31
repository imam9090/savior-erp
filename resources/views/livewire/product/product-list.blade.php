<div class="max-w-4xl mx-auto mt-10 space-y-4">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">Produk & Jasa</h2>
            <p class="text-sm text-slate-400 mt-0.5">Daftar item yang bisa dipilih saat membuat invoice</p>
        </div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-1.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-colors shadow-sm shadow-orange-200">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Tambah Item
        </a>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl p-3.5">{{ session('success') }}</div>
    @endif

    <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 bg-slate-50/60">
                    <th class="py-3 px-5 font-medium">Nama</th>
                    <th class="py-3 px-5 font-medium">Tipe</th>
                    <th class="py-3 px-5 font-medium">Satuan</th>
                    <th class="py-3 px-5 font-medium text-right">Harga</th>
                    <th class="py-3 px-5 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($products as $product)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 px-5 text-slate-700 font-medium">{{ $product->name }}</td>
                        <td class="py-3.5 px-5">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium capitalize {{ $product->type === 'barang' ? 'bg-blue-50 text-blue-600' : 'bg-violet-50 text-violet-600' }}">
                                {{ $product->type }}
                            </span>
                        </td>
                        <td class="py-3.5 px-5 text-slate-500">{{ $product->unit }}</td>
                        <td class="py-3.5 px-5 text-right text-slate-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-3.5 px-5 text-right">
                            <button
                                x-data
                                @click="if (confirm('Hapus {{ $product->name }}?')) { $wire.delete({{ $product->id }}) }"
                                class="inline-flex items-center gap-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-slate-400">Belum ada produk/jasa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($products->hasPages())
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-3">
            {{ $products->links() }}
        </div>
    @endif
</div>