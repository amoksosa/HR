<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\AttendanceLog;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $today = now()->toDateString();

        $hasAttendance = Schema::hasTable('attendance_logs');

        $todayLog   = null;
        $recentLogs = collect();

        if ($hasAttendance) {
            $todayLog = AttendanceLog::query()
                ->where('user_id', $user->id)
                ->where('log_date', $today)
                ->first();

            $recentLogs = AttendanceLog::query()
                ->where('user_id', $user->id)
                ->orderByDesc('log_date')
                ->limit(31) // last 31 days shown
                ->get();
        }

        return view('auth.dashboard', compact(
            'user',
            'today',
            'hasAttendance',
            'todayLog',
            'recentLogs'
        ));
    }
}
