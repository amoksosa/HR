<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  {{-- Tailwind via Vite + custom CSS --}}
  @vite(['resources/css/app.css', 'resources/css/admin-hrmate.css'])
</head>

<body class="min-h-screen admin-page text-slate-900">
  {{-- Page background --}}
  <div class="admin-bg"></div>

  <div class="mx-auto max-w-[1280px] px-4 sm:px-6 lg:px-8 py-6">
    {{-- Top Navbar --}}
    <header class="admin-topbar">
      <div class="flex items-center gap-3">
        <div class="admin-logo">
          <span class="admin-logo-dot"></span>
        </div>
        <div class="leading-tight">
          <div class="text-lg font-extrabold tracking-tight">Admin</div>
        </div>
      </div>

      <nav class="hidden md:flex items-center gap-1">
        <a class="admin-navlink admin-navlink--active" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="admin-navlink" href="#schedule">Schedule</a>
        <a class="admin-navlink" href="#attendance">Attendance</a>
        <a class="admin-navlink" href="#employees">Employees</a>
      </nav>

      <div class="flex items-center gap-3">
        <div class="admin-search hidden sm:flex">
          <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none">
            <path d="M21 21l-4.3-4.3m1.3-5.2a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input placeholder="Search employee, role, etc" />
        </div>

        <div class="hidden sm:flex items-center gap-2">
          <div class="text-right">
            <div class="text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</div>
          </div>
          <div class="admin-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
          </div>
        </div>

        <a href="{{ route('dashboard') }}" class="admin-btn admin-btn--soft">
          Employee View
        </a>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="admin-btn admin-btn--primary">Logout</button>
        </form>
      </div>
    </header>

    {{-- Welcome / highlight row --}}
    <section class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-4">
      <div class="lg:col-span-8 admin-hero">
        <div class="flex items-start justify-between gap-3">
          <div>
            <div class="text-sm text-slate-500">
              Today: <span class="font-semibold text-slate-700">{{ $today }}</span>
            </div>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight">
              Hello, {{ auth()->user()->name ?? 'Admin' }} <span class="inline-block">👋</span>
            </h1>
            <p class="mt-2 text-slate-600">
              Track employees, schedules, and attendance from your database.
            </p>
          </div>

          <div class="hidden sm:flex items-center gap-2">
            <a href="#employees" class="admin-btn admin-btn--primary">View Employees</a>
            <a href="#attendance" class="admin-btn admin-btn--soft">Attendance</a>
          </div>
        </div>

        {{-- KPI cards --}}
        <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">
          <div class="admin-kpi">
            <div class="admin-kpi-icon">
              <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                <path d="M16 11c1.66 0 3-1.57 3-3.5S17.66 4 16 4s-3 1.57-3 3.5S14.34 11 16 11z" stroke="currentColor" stroke-width="2"/>
                <path d="M8 12c1.66 0 3-1.79 3-4S9.66 4 8 4 5 5.79 5 8s1.34 4 3 4z" stroke="currentColor" stroke-width="2"/>
                <path d="M16 13c-2.33 0-7 1.17-7 3.5V20h14v-3.5c0-2.33-4.67-3.5-7-3.5z" stroke="currentColor" stroke-width="2"/>
                <path d="M8 14c-2.67 0-8 1.34-8 4v2h8" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
            <div class="mt-3 text-3xl font-extrabold">{{ $totalEmployees }}</div>
            <div class="text-sm text-slate-500">Total Employees</div>
          </div>

          <div class="admin-kpi">
            <div class="admin-kpi-icon">
              <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                <path d="M12 8v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
            <div class="mt-3 text-3xl font-extrabold">{{ $presentToday }}</div>
            <div class="text-sm text-slate-500">
              Present Today
              @if(!$hasAttendance)
                <span class="ml-1 text-xs text-amber-600 font-semibold">(attendance_logs not set)</span>
              @endif
            </div>
          </div>

          <div class="admin-kpi">
            <div class="admin-kpi-icon">
              <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5">
                <path d="M7 7h10M7 11h10M7 15h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6a3 3 0 013-3z" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
            <div class="mt-3 text-3xl font-extrabold">{{ $employees->count() }}</div>
            <div class="text-sm text-slate-500">Employees Loaded</div>
          </div>
        </div>
      </div>

     
    </section>

    {{-- Middle row: Attendance Overview + Schedule placeholder --}}
    <section class="mt-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
      {{-- Attendance Overview (uses latestTimeIns from DB) --}}
      <div id="attendance" class="lg:col-span-8 admin-card">
        <div class="admin-card-head">
          <div>
            <div class="text-sm font-bold">Attendance Overview</div>
            <div class="text-xs text-slate-500">Latest time-ins today (from attendance_logs)</div>
          </div>
          <a href="#employees" class="admin-link">See employees →</a>
        </div>

        <div class="admin-card-body">
          @if(!$hasAttendance)
            <div class="admin-alert admin-alert--warn">
              <div class="font-bold text-amber-700">Attendance table not found</div>
              <div class="text-sm text-amber-700/80 mt-1">
                Create <span class="font-semibold">attendance_logs</span> migration to show logs here.
              </div>
            </div>
          @else
            <div class="overflow-x-auto">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>Employee</th>
                    <th>Time In</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($latestTimeIns as $log)
                    <tr>
                      <td>
                        <div class="font-semibold text-slate-900">{{ $log->user->name ?? '—' }}</div>
                        <div class="text-xs text-slate-500">{{ $log->user->email ?? '' }}</div>
                      </td>
                      <td class="font-mono">
                        {{ $log->time_in ? \Carbon\Carbon::parse($log->time_in)->format('g:i A') : '—' }}
                      </td>
                      <td>
                        @php $st = $log->status ?? 'present'; @endphp
                        <span class="admin-pill {{ $st === 'late' ? 'admin-pill--late' : 'admin-pill--ok' }}">
                          {{ strtoupper($st) }}
                        </span>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" class="text-center text-slate-500 py-6">No time-ins found for today.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>

      {{-- Schedule (shows schedule per employee in table below; this panel is just a “summary block”) --}}
      <div id="schedule" class="lg:col-span-4 admin-card">
        <div class="admin-card-head">
          <div>
            <div class="text-sm font-bold">Schedule</div>
            <div class="text-xs text-slate-500">Shows per-employee schedule in Employees table</div>
          </div>
          <a href="#employees" class="admin-link">Open list →</a>
        </div>

        <div class="admin-card-body">
          <div class="grid grid-cols-2 gap-3">
            <div class="admin-mini">
              <div class="text-xs text-slate-500">Schedules Linked</div>
              <div class="mt-1 text-2xl font-extrabold">
                {{ $employees->whereNotNull('schedule')->count() }}
              </div>
              <div class="mt-1 text-xs text-slate-500">Users with schedule_id</div>
            </div>

            <div class="admin-mini">
              <div class="text-xs text-slate-500">No Schedule</div>
              <div class="mt-1 text-2xl font-extrabold">
                {{ $employees->whereNull('schedule')->count() }}
              </div>
              <div class="mt-1 text-xs text-slate-500">Assign schedule_id</div>
            </div>
          </div>

          <div class="mt-4 admin-alert admin-alert--info">
            <div class="font-semibold text-slate-700">Tip</div>
            <div class="text-sm text-slate-600 mt-1">
              Assign schedules in DB by setting <span class="font-semibold">users.schedule_id</span>.
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Employees List (REAL DATA from DB) --}}
    <section id="employees" class="mt-4 admin-card">
      <div class="admin-card-head">
        <div>
          <div class="text-sm font-bold">Employees</div>
        </div>

        <div class="text-sm text-slate-500">
          Total: <span class="font-semibold text-slate-700">{{ $employees->count() }}</span>
        </div>
      </div>

      <div class="admin-card-body">
        <div class="overflow-x-auto">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Employee</th>
                <th>Schedule</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
              @forelse($employees as $emp)
                @php
                  $todayLog = $emp->attendanceLogs->first();
                  $status = $todayLog->status ?? ($todayLog?->time_in ? 'present' : 'absent');
                @endphp

                <tr>
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="admin-avatar-sm">
                        {{ strtoupper(substr($emp->name ?? 'E', 0, 1)) }}
                      </div>
                      <div>
                        <div class="font-semibold text-slate-900">{{ $emp->name }}</div>
                        <div class="text-xs text-slate-500">{{ $emp->email }}</div>
                      </div>
                    </div>
                  </td>

                  <td>
                    @if($emp->schedule)
                      <div class="font-semibold text-slate-800">{{ $emp->schedule->name ?? 'Schedule' }}</div>
                      <div class="text-xs text-slate-500">
                        {{ $emp->schedule->start_time ?? '' }}{{ ($emp->schedule->start_time && $emp->schedule->end_time) ? ' - ' : '' }}{{ $emp->schedule->end_time ?? '' }}
                      </div>
                    @else
                      <span class="text-slate-500">No schedule</span>
                    @endif
                  </td>

                  <td class="font-mono">
                    {{ $todayLog?->time_in ? \Carbon\Carbon::parse($todayLog->time_in)->format('g:i A') : '—' }}
                  </td>

                  <td class="font-mono">
                    {{ $todayLog?->time_out ? \Carbon\Carbon::parse($todayLog->time_out)->format('g:i A') : '—' }}
                  </td>

                  <td>
                    <span class="admin-pill
                      {{ $status === 'late'
                          ? 'admin-pill--late'
                          : ($status === 'absent'
                              ? 'admin-pill--muted'
                              : 'admin-pill--ok') }}">
                      {{ strtoupper($status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-slate-500 py-6">No employees found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3 text-xs text-slate-500">
          This table is the “inside UI” that stays synced with your database: <span class="font-semibold">users</span>,
          <span class="font-semibold">schedules</span>, <span class="font-semibold">attendance_logs</span>.
        </div>
      </div>
    </section>

    {{-- Activities section kept (will show “not setup” if you don’t have it) --}}
    <section id="activities" class="mt-4 admin-card">
      <div class="admin-card-head">
        <div>
          <div class="text-sm font-bold">Activities</div>
        </div>
      </div>

      <div class="admin-card-body">
        @if(!$hasActivity)
          <div class="admin-alert admin-alert--warn">
            <div class="font-bold text-amber-700">Activity table not found</div>
            <div class="text-sm text-amber-700/80 mt-1">
              Create <span class="font-semibold">activity_logs</span> later if you want audit logs.
            </div>
          </div>
        @else
          <div class="text-sm text-slate-600">
            Activity logs enabled (your controller will populate $recentActivities if you add the model).
          </div>
        @endif
      </div>
    </section>

    <footer class="mt-8 pb-6 text-center text-xs text-slate-400">
      HR Portal • Admin Dashboard
    </footer>
  </div>
</body>
</html>
