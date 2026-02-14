<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee Monitoring</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-950 text-slate-100">
  <!-- Background glow -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_15%,rgba(56,189,248,.16),transparent_45%),radial-gradient(circle_at_75%_30%,rgba(168,85,247,.14),transparent_55%),radial-gradient(circle_at_50%_85%,rgba(255,255,255,.06),transparent_55%)]"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-slate-950 to-black opacity-90"></div>
  </div>

  <!-- Topbar -->
  <header class="sticky top-0 z-30 border-b border-white/10 bg-slate-950/70 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="h-16 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
          <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10 grid place-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M4 6h16M4 12h16M4 18h10" />
            </svg>
          </div>
          <div>
            <div class="font-semibold leading-tight">Employee Monitoring</div>
            <div class="text-xs text-slate-400">Live status • Attendance • Activity</div>
          </div>
        </div>

        <div class="flex items-center gap-2">
          <button class="hidden sm:inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
            Live
          </button>
          <button class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
            Export
          </button>
          <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10"></div>
        </div>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <!-- KPI Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-5">
        <div class="text-sm text-slate-300">On Shift</div>
        <div class="mt-2 flex items-end justify-between">
          <div class="text-3xl font-bold">48</div>
          <span class="text-xs text-emerald-300 bg-emerald-500/10 border border-emerald-500/20 px-2 py-1 rounded-full">+6%</span>
        </div>
        <div class="mt-4 h-2 rounded-full bg-white/10 overflow-hidden">
          <div class="h-full w-[70%] bg-emerald-400/80"></div>
        </div>
      </div>

      <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-5">
        <div class="text-sm text-slate-300">On Break</div>
        <div class="mt-2 flex items-end justify-between">
          <div class="text-3xl font-bold">9</div>
          <span class="text-xs text-sky-300 bg-sky-500/10 border border-sky-500/20 px-2 py-1 rounded-full">stable</span>
        </div>
        <div class="mt-4 h-2 rounded-full bg-white/10 overflow-hidden">
          <div class="h-full w-[25%] bg-sky-400/80"></div>
        </div>
      </div>

      <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-5">
        <div class="text-sm text-slate-300">Late</div>
        <div class="mt-2 flex items-end justify-between">
          <div class="text-3xl font-bold">3</div>
          <span class="text-xs text-rose-300 bg-rose-500/10 border border-rose-500/20 px-2 py-1 rounded-full">attention</span>
        </div>
        <div class="mt-4 h-2 rounded-full bg-white/10 overflow-hidden">
          <div class="h-full w-[8%] bg-rose-400/80"></div>
        </div>
      </div>

      <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-5">
        <div class="text-sm text-slate-300">Offline</div>
        <div class="mt-2 flex items-end justify-between">
          <div class="text-3xl font-bold">12</div>
          <span class="text-xs text-slate-300 bg-white/5 border border-white/10 px-2 py-1 rounded-full">ok</span>
        </div>
        <div class="mt-4 h-2 rounded-full bg-white/10 overflow-hidden">
          <div class="h-full w-[18%] bg-slate-400/70"></div>
        </div>
      </div>
    </section>

    <!-- Controls -->
    <section class="mt-6 rounded-3xl border border-white/10 bg-white/5 backdrop-blur p-4 sm:p-5">
      <div class="flex flex-col lg:flex-row lg:items-center gap-3 lg:gap-4">
        <!-- Search -->
        <div class="flex-1 relative">
          <input
            type="text"
            placeholder="Search employee (name, ID, department)..."
            class="w-full rounded-2xl bg-slate-900/40 border border-white/10 px-4 py-3 pl-11 text-slate-100 placeholder:text-slate-400 outline-none focus:ring-2 focus:ring-sky-500/60 focus:border-sky-500/40"
          />
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M21 21l-4.3-4.3m1.8-5.2a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>

        <!-- Filters -->
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:flex gap-3">
          <select class="rounded-2xl bg-slate-900/40 border border-white/10 px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-sky-500/60">
            <option>All Departments</option>
            <option>HR</option>
            <option>IT</option>
            <option>Operations</option>
            <option>Sales</option>
          </select>

          <select class="rounded-2xl bg-slate-900/40 border border-white/10 px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-sky-500/60">
            <option>All Status</option>
            <option>On Shift</option>
            <option>On Break</option>
            <option>Late</option>
            <option>Offline</option>
          </select>

          <select class="rounded-2xl bg-slate-900/40 border border-white/10 px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-sky-500/60">
            <option>All Sites</option>
            <option>Main Office</option>
            <option>Bacolod</option>
            <option>Cebu</option>
          </select>

          <button class="rounded-2xl bg-sky-500/90 hover:bg-sky-500 text-slate-950 font-semibold px-4 py-3 text-sm transition">
            Apply
          </button>
        </div>
      </div>

      <!-- Active filter chips -->
      <div class="mt-4 flex flex-wrap gap-2 text-xs">
        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-slate-200">Department: All</span>
        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-slate-200">Status: All</span>
        <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-slate-200">Site: All</span>
        <button class="rounded-full border border-rose-500/20 bg-rose-500/10 px-3 py-1 text-rose-200 hover:bg-rose-500/15">
          Clear
        </button>
      </div>
    </section>

    <!-- Table -->
    <section class="mt-6 rounded-3xl border border-white/10 bg-white/5 backdrop-blur overflow-hidden">
      <div class="p-5 flex items-center justify-between">
        <div>
          <div class="font-semibold">Live Employees</div>
          <div class="text-xs text-slate-400">Updated: <span id="updatedAt"></span></div>
        </div>

        <div class="flex items-center gap-2">
          <button class="rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
            Refresh
          </button>
          <button class="rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
            Settings
          </button>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead class="bg-slate-900/40 border-y border-white/10">
            <tr class="text-left text-xs uppercase tracking-wide text-slate-300">
              <th class="px-5 py-3">Employee</th>
              <th class="px-5 py-3">Department</th>
              <th class="px-5 py-3">Status</th>
              <th class="px-5 py-3">Time In</th>
              <th class="px-5 py-3">Last Activity</th>
              <th class="px-5 py-3">Productivity</th>
              <th class="px-5 py-3 text-right">Action</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-white/10">
            <!-- Row 1 -->
            <tr class="hover:bg-white/5">
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10"></div>
                  <div>
                    <div class="font-semibold text-slate-100">Levilyn Faburada</div>
                    <div class="text-xs text-slate-400">ID: 100054 • Bacolod</div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200">Operations</td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 text-xs font-semibold text-emerald-200">
                  <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                  On Shift
                </span>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200 font-mono">7:21:31 PM</td>
              <td class="px-5 py-4 text-sm text-slate-300">2 min ago</td>
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-2 w-24 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full w-[78%] bg-emerald-400/80"></div>
                  </div>
                  <span class="text-xs text-slate-300">78%</span>
                </div>
              </td>
              <td class="px-5 py-4 text-right">
                <a href="#"
                  class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
                  View
                </a>
              </td>
            </tr>

            <!-- Row 2 -->
            <tr class="hover:bg-white/5">
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10"></div>
                  <div>
                    <div class="font-semibold text-slate-100">Mark Dela Cruz</div>
                    <div class="text-xs text-slate-400">ID: 100128 • Main Office</div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200">IT</td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center gap-2 rounded-full bg-sky-500/10 border border-sky-500/20 px-3 py-1 text-xs font-semibold text-sky-200">
                  <span class="h-2 w-2 rounded-full bg-sky-400"></span>
                  On Break
                </span>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200 font-mono">6:58:03 PM</td>
              <td class="px-5 py-4 text-sm text-slate-300">8 min ago</td>
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-2 w-24 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full w-[42%] bg-sky-400/80"></div>
                  </div>
                  <span class="text-xs text-slate-300">42%</span>
                </div>
              </td>
              <td class="px-5 py-4 text-right">
                <a href="#"
                  class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
                  View
                </a>
              </td>
            </tr>

            <!-- Row 3 -->
            <tr class="hover:bg-white/5">
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10"></div>
                  <div>
                    <div class="font-semibold text-slate-100">Jessa Mae Santos</div>
                    <div class="text-xs text-slate-400">ID: 100077 • Cebu</div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200">Sales</td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center gap-2 rounded-full bg-rose-500/10 border border-rose-500/20 px-3 py-1 text-xs font-semibold text-rose-200">
                  <span class="h-2 w-2 rounded-full bg-rose-400"></span>
                  Late
                </span>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200 font-mono">7:55:12 PM</td>
              <td class="px-5 py-4 text-sm text-slate-300">Just now</td>
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-2 w-24 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full w-[15%] bg-rose-400/80"></div>
                  </div>
                  <span class="text-xs text-slate-300">15%</span>
                </div>
              </td>
              <td class="px-5 py-4 text-right">
                <a href="#"
                  class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
                  View
                </a>
              </td>
            </tr>

            <!-- Row 4 -->
            <tr class="hover:bg-white/5">
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-10 w-10 rounded-2xl bg-white/10 border border-white/10"></div>
                  <div>
                    <div class="font-semibold text-slate-100">Paolo Reyes</div>
                    <div class="text-xs text-slate-400">ID: 100201 • Main Office</div>
                  </div>
                </div>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200">HR</td>
              <td class="px-5 py-4">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-white/10 px-3 py-1 text-xs font-semibold text-slate-200">
                  <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                  Offline
                </span>
              </td>
              <td class="px-5 py-4 text-sm text-slate-200 font-mono">—</td>
              <td class="px-5 py-4 text-sm text-slate-300">1 hr ago</td>
              <td class="px-5 py-4">
                <div class="flex items-center gap-3">
                  <div class="h-2 w-24 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full w-[0%] bg-slate-400/70"></div>
                  </div>
                  <span class="text-xs text-slate-300">0%</span>
                </div>
              </td>
              <td class="px-5 py-4 text-right">
                <a href="#"
                  class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 text-sm font-semibold transition">
                  View
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Footer row -->
      <div class="p-5 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-300">
        <div>Showing <span class="text-slate-100 font-semibold">1–4</span> of <span class="text-slate-100 font-semibold">72</span> employees</div>
        <div class="flex items-center gap-2">
          <button class="rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 font-semibold transition">Prev</button>
          <button class="rounded-2xl border border-white/10 bg-white/5 hover:bg-white/10 px-4 py-2 font-semibold transition">Next</button>
        </div>
      </div>
    </section>
  </main>

  <script>
    const now = new Date();
    document.getElementById("updatedAt").textContent = now.toLocaleString(undefined, {
      month: "short",
      day: "2-digit",
      year: "numeric",
      hour: "numeric",
      minute: "2-digit",
      second: "2-digit"
    });
  </script>
</body>
</html>
