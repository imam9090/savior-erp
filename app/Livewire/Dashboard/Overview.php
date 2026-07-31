<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Overview extends Component
{
    public function render()
    {
        $user = Auth::user();
        $role = $user->role->value;

        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();

        $unreadMessages = Message::where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->count();

        $projectsQuery = Project::query();
        if ($role === 'client') {
            $projectsQuery->where('client_id', $user->id);
        } elseif (in_array($role, ['admin_client', 'admin_finance'])) {
            $projectsQuery->whereHas('members', fn ($q) => $q->where('user_id', $user->id));
        }
        $activeProjects = $projectsQuery->count();

        $invoiceStats = null;
        $invoiceTrend = collect();
        $topClients = collect();

        if (in_array($role, ['superadmin', 'admin_finance', 'client'])) {
            $invoiceQuery = Invoice::query();
            if ($role === 'client') {
                $invoiceQuery->where('client_id', $user->id);
            }

            $totalInvoices = (clone $invoiceQuery)->count();
            $paidInvoices = (clone $invoiceQuery)->where('status', 'paid')->count();

            $invoiceStats = [
                'unpaid' => (clone $invoiceQuery)->whereIn('status', ['draft', 'sent'])->count(),
                'unpaid_total' => (clone $invoiceQuery)->whereIn('status', ['draft', 'sent'])->sum('total'),
                'this_month' => (clone $invoiceQuery)->whereMonth('issue_date', now()->month)->whereYear('issue_date', now()->year)->sum('total'),
                'paid_percentage' => $totalInvoices > 0 ? round(($paidInvoices / $totalInvoices) * 100) : 0,
                'paid_count' => $paidInvoices,
                'total_count' => $totalInvoices,
            ];

            $invoiceTrend = collect(range(6, 0))->map(function ($daysAgo) use ($invoiceQuery) {
                $date = today()->subDays($daysAgo);
                return (clone $invoiceQuery)->whereDate('issue_date', $date)->sum('total');
            });

            if (in_array($role, ['superadmin', 'admin_finance'])) {
                $topClients = Invoice::selectRaw('client_id, SUM(total) as total_amount, COUNT(*) as invoice_count')
                    ->groupBy('client_id')
                    ->orderByDesc('total_amount')
                    ->with('client')
                    ->take(5)
                    ->get();
            }
        }

        $totalUsers = null;
        if ($role === 'superadmin') {
            $totalUsers = User::count();
        }

        $weeklyAttendance = collect(range(6, 0))->map(function ($daysAgo) use ($user) {
            $date = today()->subDays($daysAgo);
            $present = Attendance::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->exists();

            return [
                'label' => $date->translatedFormat('D'),
                'present' => $present,
            ];
        });

        // Kalender bulan ini (kalender biasa, bukan absensi)
$firstDayOfMonth = now()->startOfMonth();
$startOffset = $firstDayOfMonth->dayOfWeekIso - 1; // 0 = Senin

$calendarDays = collect();

// Sel kosong sebelum tanggal 1 (biar sejajar sesuai hari)
for ($i = 0; $i < $startOffset; $i++) {
    $calendarDays->push(['day' => null, 'isToday' => false]);
}

for ($day = 1; $day <= now()->daysInMonth; $day++) {
    $date = $firstDayOfMonth->copy()->addDays($day - 1);
    $calendarDays->push([
        'day' => $day,
        'isToday' => $date->isToday(),
    ]);
}

        return view('livewire.dashboard.overview', [
            'user' => $user,
            'role' => $role,
            'todayAttendance' => $todayAttendance,
            'unreadMessages' => $unreadMessages,
            'activeProjects' => $activeProjects,
            'invoiceStats' => $invoiceStats,
            'totalUsers' => $totalUsers,
            'weeklyAttendance' => $weeklyAttendance,
            'invoiceTrend' => $invoiceTrend,
            'topClients' => $topClients,
            'calendarDays' => $calendarDays,
        ]);
    }
}