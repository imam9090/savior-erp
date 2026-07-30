<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderByDesc('date')
            ->paginate(15);

        return view('livewire.attendance.attendance-history', [
            'attendances' => $attendances,
        ]);
    }
}