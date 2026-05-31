<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar – TumblrVault</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="page-login">

  <div class="login-grain"></div>
  <div class="login-deco-line"></div>
  <div class="login-deco-line"></div>
  <div class="login-dots">
    <div class="login-dot"></div><div class="login-dot"></div>
    <div class="login-dot"></div><div class="login-dot"></div>
    <div class="login-dot"></div>
  </div>

  <div class="login-card-wrap">
    <div class="login-card">

      <div class="login-card-header">
        <div class="login-brand-mark">
          <div class="login-brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2C9.24 2 7 4.24 7 7v1H5v14h14V8h-2V7c0-2.76-2.24-5-5-5zm0 2c1.66 0 3 1.34 3 3v1H9V7c0-1.66 1.34-3 3-3zm0 9a2 2 0 110 4 2 2 0 010-4z"/>
            </svg>
          </div>
          <span class="login-brand-name">TumblrVault</span>
        </div>
        <h1 class="login-card-title">Daftar<br><em>Akun Baru</em></h1>
        <p class="login-card-subtitle">Buat akun untuk mengelola Tumblr Anda</p>
      </div>

      <div class="login-card-body">
        
        {{-- Tampilkan error (Breeze style) --}}
        @if($errors->any())
          <div class="alert d-flex align-items-center gap-2 mb-4 py-2 px-3"
               style="border-radius:10px;font-size:0.84rem;border:none;
                      background:rgba(201,123,90,0.12);color:#a05a2c;
                      border-left:4px solid #c97b5a;" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}" autocomplete="off">
          @csrf

          <div class="login-field">
            <label for="name">Nama Lengkap</label>
            <div class="login-input-wrap">
              <input type="text" id="name" name="name"
                placeholder="Masukkan nama"
                value="{{ old('name') }}"
                required autofocus autocomplete="name" />
              <span class="icon">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                </svg>
              </span>
            </div>
          </div>

          <div class="login-field">
            <label for="email">Email</label>
            <div class="login-input-wrap">
              <input type="email" id="email" name="email"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
                required autocomplete="username" />
              <span class="icon">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                </svg>
              </span>
            </div>
          </div>

          <div class="login-field">
            <label for="password">Password</label>
            <div class="login-input-wrap">
              <input type="password" id="password" name="password"
                placeholder="Buat password" required autocomplete="new-password" />
              <span class="icon">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
              </span>
              <button type="button" class="login-eye-toggle" onclick="togglePassword('password', 'eye-icon')">
                <svg id="eye-icon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="login-field">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="login-input-wrap">
              <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Ulangi password" required autocomplete="new-password" />
              <span class="icon">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
              </span>
              <button type="button" class="login-eye-toggle" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')">
                <svg id="eye-icon-confirm" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="login-field d-flex justify-content-center my-3">
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
          </div>

          <div class="login-field mt-4">
            <button type="submit" class="login-btn-submit">Daftar Akun</button>
          </div>

        </form>

        <a href="{{ route('login') }}" class="login-back-link">
          Sudah punya akun? Masuk
        </a>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon  = document.getElementById(iconId);
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
      } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
      }
    }
  </script>
</body>
</html>
