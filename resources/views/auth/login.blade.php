<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Company Login</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

  
  <script src="https://cdn.tailwindcss.com"></script>

  
  @vite(['resources/css/home.css'])
</head>

<body class="min-h-screen text-slate-100 auth-body">
  <!-- Background -->
  <div class="fixed inset-0 -z-10 auth-bg">
    <div class="auth-bg__radial"></div>
    <div class="auth-bg__overlay"></div>
  </div>

  <div class="min-h-screen flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
      <!-- Top brand -->
      <div class="mb-6 text-center">
        <div class="mx-auto w-14 h-14 auth-logo">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" class="opacity-90">
            <path d="M12 2l8 4v6c0 5-3.2 9.4-8 10-4.8-.6-8-5-8-10V6l8-4z" stroke="currentColor" stroke-width="1.6"/>
            <path d="M8.2 12.2l2.2 2.3 5.6-5.7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h1 class="mt-4 text-2xl font-bold tracking-tight">GJL HR PORTAL</h1>
        <p class="mt-1 text-sm text-slate-300">Sign in to access your account.</p>
      </div>

      <!-- Card -->
      <div class="auth-card">
        <div class="p-6 sm:p-8">
          <!-- Errors -->
          @if ($errors->any())
            <div class="mb-5 auth-alert auth-alert--error">
              <div class="font-semibold mb-1">Please check your details:</div>
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Email</label>
              <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="you@company.com"
                class="w-full auth-input"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Password</label>
              <input
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full auth-input"
              />
            </div>

            <div class="flex items-center justify-between gap-3">
              <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                <input type="checkbox" name="remember" class="auth-check" />
                Remember me
              </label>

              <a href="#" class="text-sm font-medium text-blue-300 hover:text-blue-200 hover:underline">
                Forgot password?
              </a>
            </div>

            <button type="submit" class="w-full auth-btn auth-btn--primary">
              Sign in
            </button>
          </form>

          <div class="mt-6 flex items-center gap-3">
            <div class="h-px flex-1 bg-white/10"></div>
            <div class="text-xs text-slate-400">or</div>
            <div class="h-px flex-1 bg-white/10"></div>
          </div>

          <p class="mt-5 text-center text-sm text-slate-300">
            No account yet?
            <a href="{{ route('register') }}" class="font-semibold text-blue-300 hover:text-blue-200 hover:underline">
              Create an account
            </a>
          </p>
        </div>

        <div class="border-t border-white/10 px-6 py-4 text-center text-xs text-slate-400">
          © {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
      </div>

      <p class="mt-6 text-center text-xs text-slate-400">
        Tip: Use your company email to sign in.
      </p>
    </div>
  </div>
</body>
</html>
