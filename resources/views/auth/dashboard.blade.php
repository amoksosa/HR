<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee Dashboard</title>

  {{-- Tailwind via Vite + custom CSS --}}
  @vite(['resources/css/app.css', 'resources/css/employee-hrmate.css'])
</head>

<body class="min-h-screen emp-page text-slate-900">
  <div class="emp-bg"></div>

  <div class="mx-auto max-w-[1100px] px-4 sm:px-6 lg:px-8 py-6">
    {{-- Top Bar --}}
    <header class="emp-topbar">
      <div class="flex items-center gap-3">
        <div class="emp-logo">
          <span class="emp-logo-dot"></span>
        </div>
        <div class="leading-tight">
          <div class="text-lg font-extrabold tracking-tight">GJL</div>
        </div>
      </div>

      <div class="hidden sm:flex items-center gap-2">
        <div class="text-right">
          <div class="text-xs text-slate-500">Today</div>
          <div class="text-sm font-semibold">{{ $today }}</div>
        </div>
      </div>

      <div class="flex items-center gap-3">
        @if(($user->role ?? null) === 'admin' || (int)($user->is_admin ?? 0) === 1)
          <a href="{{ route('admin.dashboard') }}" class="emp-btn emp-btn--soft">
            Admin View
          </a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="emp-btn emp-btn--primary">Logout</button>
        </form>

        <div class="emp-avatar">
          {{ strtoupper(substr($user->name ?? 'E', 0, 1)) }}
        </div>
      </div>
    </header>

    {{-- Welcome --}}
    <section class="mt-6 emp-hero">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div>
          <div class="text-sm text-slate-500">Welcome back,</div>
          <h1 class="mt-1 text-3xl sm:text-4xl font-extrabold tracking-tight">
            {{ $user->name }} <span class="inline-block">👋</span>
          </h1>
          <p class="mt-2 text-slate-600">
            This page shows your own attendance and your registered information.
          </p>
        </div>

        <div class="grid grid-cols-2 gap-3 min-w-[240px]">
          <div class="emp-kpi">
            <div class="text-xs text-slate-500">Status Today</div>
            @php
              $statusToday = 'absent';
              if ($hasAttendance && $todayLog) {
                $statusToday = $todayLog->status ?? ($todayLog->time_in ? 'present' : 'absent');
              }
            @endphp
            <div class="mt-2">
              <span class="emp-pill
                {{ $statusToday === 'late'
                    ? 'emp-pill--late'
                    : ($statusToday === 'absent'
                        ? 'emp-pill--muted'
                        : 'emp-pill--ok') }}">
                {{ strtoupper($statusToday) }}
              </span>
            </div>
          </div>

          <div class="emp-kpi">
            <div class="text-xs text-slate-500">Time In</div>
            <div class="mt-2 text-xl font-extrabold font-mono">
              {{ ($hasAttendance && $todayLog && $todayLog->time_in) ? \Carbon\Carbon::parse($todayLog->time_in)->format('g:i A') : '—' }}
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Row: Profile + Today Attendance --}}
    <section class="mt-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
      {{-- Profile info (registered fields) --}}
      <div class="lg:col-span-5 emp-card">
        <div class="emp-card-head">
          <div>
            <div class="text-sm font-bold">My Profile</div>
            <div class="text-xs text-slate-500">Registered information</div>
          </div>
        </div>

        <div class="emp-card-body">
          <div class="space-y-3">
            <div class="emp-row">
              <div class="emp-label">Name</div>
              <div class="emp-value">{{ $user->name }}</div>
            </div>

            <div class="emp-row">
              <div class="emp-label">Email</div>
              <div class="emp-value">{{ $user->email }}</div>
            </div>

            <div class="emp-row">
              <div class="emp-label">Role</div>
              <div class="emp-value">{{ $user->role ?? 'employee' }}</div>
            </div>

            <div class="emp-row">
              <div class="emp-label">Registered</div>
              <div class="emp-value">
                {{ $user->created_at ? $user->created_at->format('M d, Y g:i A') : '—' }}
              </div>
            </div>
          </div>

          <div class="mt-4 emp-note">
            Only your own information is shown here.
          </div>
        </div>
      </div>

      {{-- Today attendance details --}}
      <div class="lg:col-span-7 emp-card">
        <div class="emp-card-head">
          <div>
            <div class="text-sm font-bold">Today Attendance</div>
            <div class="text-xs text-slate-500">From attendance_logs</div>
          </div>
        </div>

        <div class="emp-card-body">
          @if(!$hasAttendance)
            <div class="emp-alert emp-alert--warn">
              <div class="font-bold text-amber-700">attendance_logs table not found</div>
              <div class="text-sm text-amber-700/80 mt-1">
                Create attendance_logs migration to enable attendance display.
              </div>
            </div>
          @else
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <div class="emp-mini">
                <div class="text-xs text-slate-500">Time In</div>
                <div class="mt-1 text-2xl font-extrabold font-mono">
                  {{ ($todayLog && $todayLog->time_in) ? \Carbon\Carbon::parse($todayLog->time_in)->format('g:i A') : '—' }}
                </div>
              </div>

              <div class="emp-mini">
                <div class="text-xs text-slate-500">Time Out</div>
                <div class="mt-1 text-2xl font-extrabold font-mono">
                  {{ ($todayLog && $todayLog->time_out) ? \Carbon\Carbon::parse($todayLog->time_out)->format('g:i A') : '—' }}
                </div>
              </div>

              <div class="emp-mini">
                <div class="text-xs text-slate-500">Status</div>
                <div class="mt-2">
                  <span class="emp-pill
                    {{ $statusToday === 'late'
                        ? 'emp-pill--late'
                        : ($statusToday === 'absent'
                            ? 'emp-pill--muted'
                            : 'emp-pill--ok') }}">
                    {{ strtoupper($statusToday) }}
                  </span>
                </div>
              </div>
            </div>

            <div class="mt-3 text-xs text-slate-500">
              If you have no log today, it will show as absent.
            </div>
          @endif
        </div>
      </div>
    </section>

    {{-- Attendance history (self-only) --}}
    <section class="mt-4 emp-card">
      <div class="emp-card-head">
        <div>
          <div class="text-sm font-bold">My Attendance History</div>
          <div class="text-xs text-slate-500">Last {{ $recentLogs->count() }} record(s)</div>
        </div>
      </div>

      <div class="emp-card-body">
        @if(!$hasAttendance)
          <div class="emp-alert emp-alert--warn">
            <div class="font-bold text-amber-700">Attendance not available</div>
            <div class="text-sm text-amber-700/80 mt-1">No attendance_logs table yet.</div>
          </div>
        @else
          <div class="overflow-x-auto">
            <table class="emp-table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Status</th>
                </tr>
              </thead>

              <tbody>
                @forelse($recentLogs as $log)
                  @php
                    $st = $log->status ?? ($log->time_in ? 'present' : 'absent');
                  @endphp
                  <tr>
                    <td class="font-semibold">
                      {{ $log->log_date ? \Carbon\Carbon::parse($log->log_date)->format('M d, Y') : '—' }}
                    </td>
                    <td class="font-mono">
                      {{ $log->time_in ? \Carbon\Carbon::parse($log->time_in)->format('g:i A') : '—' }}
                    </td>
                    <td class="font-mono">
                      {{ $log->time_out ? \Carbon\Carbon::parse($log->time_out)->format('g:i A') : '—' }}
                    </td>
                    <td>
                      <span class="emp-pill
                        {{ $st === 'late'
                            ? 'emp-pill--late'
                            : ($st === 'absent'
                                ? 'emp-pill--muted'
                                : 'emp-pill--ok') }}">
                        {{ strtoupper($st) }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center text-slate-500 py-6">No attendance records found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </section>

    <footer class="mt-8 pb-6 text-center text-xs text-slate-400">
      HR Portal • Employee Dashboard
    </footer>
  </div>
</body>
</html>
