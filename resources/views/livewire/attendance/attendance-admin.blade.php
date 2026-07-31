<div class="max-w-5xl mx-auto bg-white shadow-sm shadow-slate-200/60 border border-slate-100 rounded-2xl p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Absensi Karyawan</h2>
        <input
            type="date"
            wire:model.live="date"
            class="border border-gray-300 rounded-md text-sm px-2 py-1"
        >
    </div>

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-500 border-b">
                <th class="py-2">Nama</th>
                <th class="py-2">Role</th>
                <th class="py-2">Clock In</th>
                <th class="py-2">Clock Out</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr class="border-b">
                    <td class="py-2">{{ $attendance->user->name }}</td>
                    <td class="py-2">{{ $attendance->user->role->label() }}</td>
                    <td class="py-2">{{ $attendance->clock_in?->format('H:i') ?? '-' }}</td>
                    <td class="py-2">{{ $attendance->clock_out?->format('H:i') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-400">Tidak ada data untuk tanggal ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
</div>