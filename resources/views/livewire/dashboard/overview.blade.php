<div class="max-w-7xl mx-auto mt-6 space-y-5">
    <div class="flex items-center justify-between bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl px-5 py-3">
        <div>
            <h2 class="text-lg font-semibold text-slate-800">Selamat datang, {{ $user->name }} 👋</h2>
            <p class="text-xs text-slate-400">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('messages.inbox') }}" class="relative p-2 rounded-xl hover:bg-slate-50 transition-colors">
                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                @if ($unreadMessages > 0)
                    <span class="absolute top-1 right-1 w-2 h-2 bg-orange-500 rounded-full"></span>
                @endif
            </a>
            <div class="w-9 h-9 rounded-full bg-slate-900 text-orange-400 flex items-center justify-center text-sm font-semibold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-5">
            <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-3">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <p class="text-sm text-slate-400 mb-1">Absensi Hari Ini</p>
            @if (! $todayAttendance)
                <p class="text-lg font-semibold text-amber-500">Belum Clock In</p>
            @elseif (! $todayAttendance->clock_out)
                <p class="text-lg font-semibold text-blue-500">Clock In {{ $todayAttendance->clock_in->format('H:i') }}</p>
            @else
                <p class="text-lg font-semibold text-emerald-500">Lengkap ✓</p>
            @endif
            <a href="{{ route('attendance') }}" class="text-xs text-orange-600 hover:underline mt-3 inline-flex items-center gap-1">
                Ke halaman absensi
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>

        <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-5">
            <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-3">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
            </div>
            <p class="text-sm text-slate-400 mb-1">Pesan Belum Dibaca</p>
            <p class="text-lg font-semibold text-slate-800">{{ $unreadMessages }} pesan</p>
            <a href="{{ route('messages.inbox') }}" class="text-xs text-orange-600 hover:underline mt-3 inline-flex items-center gap-1">
                Buka pesan
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>

        <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-5">
            <div class="w-10 h-10 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center mb-3">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5" /></svg>
            </div>
            <p class="text-sm text-slate-400 mb-1">Proyek Aktif</p>
            <p class="text-lg font-semibold text-slate-800">{{ $activeProjects }} proyek</p>
            <a href="{{ route('projects.index') }}" class="text-xs text-orange-600 hover:underline mt-3 inline-flex items-center gap-1">
                Lihat proyek
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6">
            <h3 class="text-base font-semibold text-slate-800 mb-1">Aktivitas Absensi 7 Hari Terakhir</h3>
            <p class="text-xs text-slate-400 mb-6">Riwayat kehadiranmu minggu ini</p>

            <div class="flex items-end justify-between gap-3 h-32">
                @foreach ($weeklyAttendance as $day)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full flex items-end justify-center gap-1 h-24">
                            <div class="w-1/2 max-w-[14px] rounded-t-lg {{ $day['present'] ? 'h-full bg-orange-500' : 'h-[10%] bg-slate-100' }}"></div>
                            <div class="w-1/2 max-w-[14px] rounded-t-lg {{ ! $day['present'] ? 'h-full bg-slate-300' : 'h-[10%] bg-slate-100' }}"></div>
                        </div>
                        <span class="text-xs text-slate-400">{{ $day['label'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center gap-4 mt-3 text-xs text-slate-400">
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-orange-500"></span> Hadir</span>
                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-sm bg-slate-300"></span> Tidak Hadir</span>
            </div>
        </div>

        <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 flex flex-col items-center justify-center text-center">
            <h3 class="text-base font-semibold text-slate-800 mb-4 self-start">Invoice Lunas</h3>

            @php
                $pct = $invoiceStats['paid_percentage'] ?? 0;
                $circumference = 2 * pi() * 40;
                $offset = $circumference - ($pct / 100) * $circumference;
            @endphp

            <div class="relative w-32 h-32">
                <svg class="w-32 h-32 -rotate-90">
                    <circle cx="64" cy="64" r="40" stroke="#f1f5f9" stroke-width="12" fill="none" />
                    <circle
                        cx="64" cy="64" r="40"
                        stroke="#f97316"
                        stroke-width="12"
                        fill="none"
                        stroke-linecap="round"
                        stroke-dasharray="{{ $circumference }}"
                        stroke-dashoffset="{{ $offset }}"
                    />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-2xl font-bold text-slate-800">{{ $pct }}%</span>
                </div>
            </div>

            <p class="text-xs text-slate-400 mt-4">{{ $invoiceStats['paid_count'] ?? 0 }} dari {{ $invoiceStats['total_count'] ?? 0 }} invoice lunas</p>
        </div>
    </div>

    @if ($topClients->isNotEmpty())
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6">
                <p class="text-xs text-slate-400 mb-1">Tren Invoice 7 Hari</p>
                <p class="text-xl font-semibold text-slate-800 mb-3">Rp {{ number_format($invoiceTrend->sum(), 0, ',', '.') }}</p>
                <svg viewBox="0 0 200 50" class="w-full h-12" preserveAspectRatio="none">
                    @php
                        $max = max($invoiceTrend->max(), 1);
                        $points = $invoiceTrend->values()->map(function ($val, $i) use ($max, $invoiceTrend) {
                            $x = $invoiceTrend->count() > 1 ? ($i / ($invoiceTrend->count() - 1)) * 200 : 0;
                            $y = 45 - (($val / $max) * 40);
                            return "$x,$y";
                        })->implode(' ');
                    @endphp
                    <polyline points="{{ $points }}" fill="none" stroke="#f97316" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <div class="lg:col-span-2 bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6">
                <h3 class="text-base font-semibold text-slate-800 mb-4">Klien Teratas</h3>
                <div class="space-y-3">
                    @foreach ($topClients as $entry)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xs font-semibold">
                                    {{ strtoupper(substr($entry->client->name ?? '-', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-700">{{ $entry->client->name ?? 'Klien tidak ditemukan' }}</p>
                                    <p class="text-xs text-slate-400">{{ $entry->invoice_count }} invoice</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($entry->total_amount, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 {{ $totalUsers !== null ? 'lg:grid-cols-3' : '' }} gap-4">
        @if ($invoiceStats)
            <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 {{ $totalUsers !== null ? 'lg:col-span-2' : '' }}">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 14l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800">Ringkasan Invoice</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <p class="text-xs text-slate-400">Belum Dibayar</p>
                        <p class="text-xl font-semibold text-amber-500 mt-1">{{ $invoiceStats['unpaid'] }} invoice</p>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <p class="text-xs text-slate-400">Total Belum Dibayar</p>
                        <p class="text-xl font-semibold text-slate-800 mt-1">Rp {{ number_format($invoiceStats['unpaid_total'], 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <p class="text-xs text-slate-400">Invoice Bulan Ini</p>
                        <p class="text-xl font-semibold text-slate-800 mt-1">Rp {{ number_format($invoiceStats['this_month'], 0, ',', '.') }}</p>
                    </div>
                </div>
                <a href="{{ route('invoices.index') }}" class="text-xs text-orange-600 hover:underline mt-4 inline-flex items-center gap-1">
                    Lihat semua invoice
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        @endif

        @if ($totalUsers !== null)
            <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-slate-900 text-orange-400 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h3 class="text-base font-semibold text-slate-800">Ringkasan Tim</h3>
                </div>
                <p class="text-2xl font-semibold text-slate-800">{{ $totalUsers }}</p>
                <p class="text-sm text-slate-400 mt-0.5">user terdaftar di sistem</p>
                <a href="{{ route('users.index') }}" class="text-xs text-orange-600 hover:underline mt-4 inline-flex items-center gap-1">
                    Kelola user
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>
            </div>
        @endif
    </div>
</div>