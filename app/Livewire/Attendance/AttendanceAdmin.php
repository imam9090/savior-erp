<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceAdmin extends Component
{
    use WithPagination;

    public string $date = '';

    public function mount(): void
    {
        $this->date = today()->toDateString();
    }

    public function render()
    {
        $attendances = Attendance::with('user')
            ->whereDate('date', $this->date)
            ->orderBy('user_id')
            ->paginate(20);

        return view('livewire.attendance.attendance-admin', [
            'attendances' => $attendances,
        ]);
    }
}