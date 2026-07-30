<div class="max-w-4xl mx-auto mt-6">
    <div class="bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Riwayat Absensi Saya</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="py-2 font-medium">Tanggal</th>
                    <th class="py-2 font-medium">Clock In</th>
                    <th class="py-2 font-medium">Clock Out</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($attendances as $attendance)
                    <tr>
                        <td class="py-3 text-slate-700">{{ $attendance->date->translatedFormat('d F Y') }}</td>
                        <td class="py-3 text-slate-700">{{ $attendance->clock_in?->format('H:i') ?? '-' }}</td>
                        <td class="py-3 text-slate-700">{{ $attendance->clock_out?->format('H:i') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-slate-400">Belum ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</div>