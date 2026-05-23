<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'TumblrVault – Sistem Manajemen Penjualan Tumbler')</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  @stack('styles')
</head>
<body>

  @include('partials.navbar')

  {{-- Flash Messages --}}
  @if(session('success'))
    <div class="toast-notif show" id="flashToast">
      <i class="bi bi-check-circle-fill me-2" style="color:#4a7a4e;"></i>
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="toast-notif show" id="flashToast" style="border-left-color:#c97b5a;">
      <i class="bi bi-x-circle-fill me-2" style="color:#c97b5a;"></i>
      {{ session('error') }}
    </div>
  @endif

  {{-- Page Content --}}
  @yield('content')

  @include('partials.footer')

  {{-- Logout Modal --}}
  @auth
  <div class="modal fade modal-logout" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
      <div class="modal-content">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title d-flex align-items-center gap-2">
            <span style="width:34px;height:34px;border-radius:50%;background:rgba(102,78,68,0.1);display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-box-arrow-right" style="color:#664E44;font-size:0.9rem;"></i>
            </span>
            Konfirmasi Logout
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" style="padding:16px 24px 8px;">
          <p style="margin:0;font-size:0.88rem;color:rgba(58,44,38,0.7);">
            Hei, <strong style="color:#664E44;">{{ Auth::user()->name }}</strong>! Yakin ingin keluar?
          </p>
        </div>
        <div class="modal-footer border-0 pt-0 gap-2">
          <button type="button" class="btn-cancel-logout" data-bs-dismiss="modal">Batal</button>
          <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn-confirm-logout">
              <i class="bi bi-box-arrow-right me-1"></i>Ya, Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endauth

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/script.js') }}"></script>
  <script>
    const toast = document.getElementById('flashToast');
    if (toast) setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 500); }, 3000);
  </script>
  @stack('scripts')

</body>
</html>
