<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Account</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

  
  <script src="https://cdn.tailwindcss.com"></script>

  
  @vite(['resources/css/register.css'])
</head>

<body class="min-h-screen text-slate-100 auth-body">
  <!-- Background -->
  <div class="fixed inset-0 -z-10 auth-bg">
    <div class="auth-bg__radial auth-bg__radial--register"></div>
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

        <h1 class="mt-4 text-2xl font-bold tracking-tight">Create your account</h1>
        <p class="mt-1 text-sm text-slate-300">Use your company email to get started.</p>
      </div>

      <!-- Card -->
      <div class="auth-card">
        <div class="p-6 sm:p-8">
          <!-- Errors -->
          @if ($errors->any())
            <div class="mb-5 auth-alert auth-alert--error">
              <div class="font-semibold mb-1">Please fix the following:</div>
              <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Full name</label>
              <input
                name="name"
                value="{{ old('name') }}"
                required
                autocomplete="name"
                placeholder="Juan Dela Cruz"
                class="w-full auth-input auth-input--emerald"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Email</label>
              <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                placeholder="you@company.com"
                class="w-full auth-input auth-input--emerald"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Password</label>
              <input
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimum 6 characters"
                class="w-full auth-input auth-input--emerald"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-200 mb-1">Confirm password</label>
              <input
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Re-enter your password"
                class="w-full auth-input auth-input--emerald"
              />
            </div>

            <button type="submit" class="w-full auth-btn auth-btn--success">
              Create account
            </button>
          </form>

          <p class="mt-6 text-center text-sm text-slate-300">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-emerald-300 hover:text-emerald-200 hover:underline">
              Sign in
            </a>
          </p>
        </div>

        <div class="border-t border-white/10 px-6 py-4 text-center text-xs text-slate-400">
          By creating an account, you agree to follow company policies and acceptable use guidelines.
        </div>
      </div>

      <p class="mt-6 text-center text-xs text-slate-400">
        Need help? Contact your system administrator.
      </p>
    </div>
  </div>
</body>
</html>
