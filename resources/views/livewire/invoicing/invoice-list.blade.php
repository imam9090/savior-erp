<div class="max-w-6xl mx-auto mt-6 space-y-4">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-xl font-semibold text-slate-800">Daftar Invoice</h2>
            <p class="text-sm text-slate-400 mt-0.5">Kelola dan pantau seluruh tagihan klien</p>
        </div>
        @if (in_array(auth()->user()->role->value, ['superadmin', 'admin_finance']))
    <a href="{{ route('invoices.create') }}" class="inline-flex items-center gap-1.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-colors shadow-sm shadow-orange-200">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Buat Invoice
    </a>
@endif
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 text-emerald-700 text-sm rounded-xl p-3.5 flex items-center gap-2">
            <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-3 gap-3">
        <div class="bg-white border border-slate-100 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Total Invoice</p>
            <p class="text-xl font-semibold text-slate-800 mt-1">{{ $invoices->total() }}</p>
        </div>
        <div class="bg-white border border-slate-100 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Belum Dibayar</p>
            <p class="text-xl font-semibold text-amber-500 mt-1">{{ $invoices->where('status', 'draft')->count() + $invoices->where('status', 'sent')->count() }}</p>
        </div>
        <div class="bg-white border border-slate-100 rounded-2xl p-4">
            <p class="text-xs text-slate-400">Lunas</p>
            <p class="text-xl font-semibold text-emerald-500 mt-1">{{ $invoices->where('status', 'paid')->count() }}</p>
        </div>
    </div>

    <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 bg-slate-50/60">
                    <th class="py-3 px-5 font-medium">No. Invoice</th>
                    <th class="py-3 px-5 font-medium">Klien</th>
                    <th class="py-3 px-5 font-medium">Total</th>
                    <th class="py-3 px-5 font-medium">Status</th>
                    <th class="py-3 px-5 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($invoices as $invoice)
                    @php
                        $statusStyle = match ($invoice->status) {
                            'paid' => 'bg-emerald-50 text-emerald-600',
                            'sent' => 'bg-blue-50 text-blue-600',
                            'overdue' => 'bg-rose-50 text-rose-600',
                            default => 'bg-amber-50 text-amber-600',
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-3.5 px-5 text-slate-700 font-medium">{{ $invoice->invoice_number }}</td>
                        <td class="py-3.5 px-5 text-slate-600">{{ $invoice->client->name }}</td>
                        <td class="py-3.5 px-5 text-slate-700">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                        <td class="py-3.5 px-5">
                            <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium capitalize {{ $statusStyle }}">
                                {{ $invoice->status }}
                            </span>
                        </td>
                        <td class="py-3.5 px-5 text-right">
                            <a href="{{ route('invoices.pdf', $invoice) }}" target="_blank" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-700 font-medium">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" /></svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <svg class="h-10 w-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <p class="text-slate-400 text-sm">Belum ada invoice</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($invoices->hasPages())
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-3">
            {{ $invoices->links() }}
        </div>
    @endif
</div>