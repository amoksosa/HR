<!DOCTYPE html>
<html lang="en">

<style>
  @import url("./home.css");
</style>


<head>
@vite(['resources/css/app.css', 'resources/js/portal.js'])
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HR Portal — Login</title>
</head>

<body class="page">
  <!-- Background glow -->
  <div class="bg-glow">
    <div class="bg-glow__radials"></div>
    <div class="bg-glow__fade"></div>
  </div>

  <main class="center-wrap">
    <div class="container">

      <!-- Brand -->
      <div class="brand">
        <div class="brand__icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" style="color:#7dd3fc" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0ZM6 21a6 6 0 0112 0" />
          </svg>
        </div>
        <h1 class="brand__title">HR Portal</h1>
        <p class="brand__subtitle">Sign in to manage employees, schedules, and requests.</p>
      </div>

      <!-- Card -->
      <div class="card">
        <div class="card__body">
          <form class="form" action="#" method="POST">

            <!-- Email -->
            <div>
              <label class="label" for="email">Email</label>
              <div class="input-wrap">
                <input id="email" name="email" type="email" placeholder="hr@company.com" class="input" required />
              </div>
            </div>

            <!-- Password -->
            <div>
              <label class="label" for="password">Password</label>
              <div class="input-wrap">
                <input id="password" name="password" type="password" placeholder="••••••••"
                  class="input input--password" required />

                <button type="button" id="togglePassword" class="pw-toggle" aria-label="Toggle password visibility">
                  <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M2.036 12.322a1 1 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.577 3.01 9.964 7.178.07.207.07.431 0 .644C20.577 16.49 16.638 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>

                  <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M3 3l18 18M10.477 10.48A3 3 0 0012 15a3 3 0 002.52-4.52M9.88 4.24A10.45 10.45 0 0112 4.5c4.638 0 8.577 3.01 9.964 7.178.07.207.07.431 0 .644a10.45 10.45 0 01-2.51 4.12M6.228 6.23A10.49 10.49 0 002.036 11.678a1 1 0 000 .644C3.423 16.49 7.36 19.5 12 19.5c1.06 0 2.09-.157 3.07-.45" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Row -->
            <div class="row">
              <label class="remember">
                <input type="checkbox" class="checkbox" />
                Remember me
              </label>

              <a href="#" class="link">Forgot password?</a>
            </div>

            <!-- Button -->
            <a href="/login" class="btn-primary">Sign In</a>

            <!-- Divider -->
            <div class="divider">
              <div class="divider__line"></div>
              <span class="divider__text">or</span>
            </div>

            <!-- SSO buttons -->
            <div class="sso">
              <button type="button" class="btn-sso">Sign in with Google</button>
              <button type="button" class="btn-sso">Sign in with Microsoft</button>
            </div>

            <p class="note">By signing in, you agree to the company’s acceptable use policy.</p>
          </form>
        </div>

        <!-- Footer -->
        <div class="card__footer">
          <span>© <span id="year"></span> HR Portal</span>
          <span class="version">v1.0</span>
        </div>
      </div>
    </div>
  </main>

  <script src="portal.js"></script>
</body>

</html>
