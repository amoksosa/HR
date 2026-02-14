<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Models\AttendanceLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Total employees
        $totalEmployees = User::query()
            ->where('role', 'employee')
            ->count();

        // Tables exist?
        $hasAttendance = Schema::hasTable('attendance_logs');
        $hasActivity   = Schema::hasTable('activity_logs');

        // Employees with schedule + today's attendance
        $employees = User::query()
            ->where('role', 'employee')
            ->with([
                'schedule:id,name,start_time,end_time',
                'attendanceLogs' => function ($q) use ($today) {
                    $q->where('log_date', $today)->select([
                        'id', 'user_id', 'log_date', 'time_in', 'time_out', 'status'
                    ]);
                }
            ])
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'role', 'schedule_id', 'created_at']);

        $presentToday = 0;
        $latestTimeIns = collect();
        $recentActivities = collect();

        // Latest time-ins
        if ($hasAttendance) {
            $presentToday = AttendanceLog::where('log_date', $today)
                ->whereNotNull('time_in')
                ->count();

            $latestTimeIns = AttendanceLog::with('user')
                ->where('log_date', $today)
                ->whereNotNull('time_in')
                ->latest('time_in')
                ->limit(10)
                ->get();
        }

        // Recent activities (optional)
        if ($hasActivity && class_exists(\App\Models\ActivityLog::class)) {
            $recentActivities = \App\Models\ActivityLog::with('user')
                ->latest()
                ->limit(12)
                ->get();
        } else {
            $hasActivity = false;
        }

        return view('admin.dashboard', compact(
            'totalEmployees',
            'employees',
            'presentToday',
            'latestTimeIns',
            'recentActivities',
            'today',
            'hasAttendance',
            'hasActivity'
        ));
    }
}
