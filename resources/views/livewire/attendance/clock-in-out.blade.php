<div class="max-w-4xl mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <h2 class="text-lg font-semibold text-slate-800 mb-1">Absensi Hari Ini</h2>
    <p class="text-sm text-slate-400 mb-5">{{ today()->translatedFormat('l, d F Y') }}</p>

    <div class="space-y-3 mb-6">
        <div class="flex justify-between items-center text-sm bg-slate-50 rounded-xl px-4 py-3">
            <span class="text-slate-500">Clock In</span>
            <span class="font-semibold text-slate-800">
                {{ $todayAttendance?->clock_in?->format('H:i') ?? '-' }}
            </span>
        </div>
        <div class="flex justify-between items-center text-sm bg-slate-50 rounded-xl px-4 py-3">
            <span class="text-slate-500">Clock Out</span>
            <span class="font-semibold text-slate-800">
                {{ $todayAttendance?->clock_out?->format('H:i') ?? '-' }}
            </span>
        </div>
    </div>

    @if (! $todayAttendance)
        <button wire:click="clockIn" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 rounded-xl transition-colors">
            Clock In
        </button>
    @elseif (! $todayAttendance->clock_out)
        <button wire:click="clockOut" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-medium py-2.5 rounded-xl transition-colors">
            Clock Out
        </button>
    @else
        <p class="text-center text-sm text-slate-400 bg-slate-50 rounded-xl py-3">Absensi hari ini sudah lengkap ✓</p>
    @endif
</div>