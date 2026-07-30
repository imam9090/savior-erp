<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClockInOut extends Component
{
    public ?Attendance $todayAttendance = null;

    public function mount(): void
    {
        $this->loadTodayAttendance();
    }

    public function loadTodayAttendance(): void
    {
        $this->todayAttendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', today())
            ->first();
    }

    public function clockIn(): void
    {
        if ($this->todayAttendance) {
            return;
        }

        $this->todayAttendance = Attendance::create([
            'user_id' => Auth::id(),
            'date' => today(),
            'clock_in' => now(),
        ]);
    }

    public function clockOut(): void
    {
        if (! $this->todayAttendance || $this->todayAttendance->clock_out) {
            return;
        }

        $this->todayAttendance->update([
            'clock_out' => now(),
        ]);

        $this->loadTodayAttendance();
    }

    public function render()
    {
        return view('livewire.attendance.clock-in-out');
    }
}