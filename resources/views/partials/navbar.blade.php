<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand-custom" href="{{ route('dashboard') }}">Tumblr<span>Vault</span></a>
    <button class="navbar-toggler navbar-toggler-custom" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-house me-1"></i>Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ request()->routeIs('products.*') && !request()->routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.index') }}">
            <i class="bi bi-box me-1"></i>Produk
          </a>
        </li>
        
        @auth
          @if(Auth::user()->isAdmin())
          <li class="nav-item ms-lg-2">
            <a class="btn btn-primary-custom {{ request()->routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">
              <i class="bi bi-plus me-1"></i>Tambah Produk
            </a>
          </li>
          @endif
          
          <li class="nav-item ms-lg-1">
            <button class="btn-wishlist-nav" data-bs-toggle="modal" data-bs-target="#wishlistModal">
              <i class="bi bi-heart-fill"></i>
              <span class="wishlist-badge" id="wishlist-badge" style="display:none;">0</span>
            </button>
          </li>
        @endauth
      </ul>

      @guest
        <div class="d-flex align-items-center gap-2 ms-lg-3 mt-3 mt-lg-0">
          <a href="{{ route('login') }}" class="btn btn-outline-custom" style="padding: 0.4rem 1rem;">Login</a>
          <a href="{{ route('register') }}" class="btn btn-primary-custom" style="padding: 0.4rem 1rem;">Register</a>
        </div>
      @endguest

      @auth
        <div class="dropdown ms-lg-3 mt-3 mt-lg-0">
          <div class="user-chip" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Avatar" class="avatar" style="object-fit: cover;">
            @else
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            @endif
            <span>{{ Auth::user()->name }}</span>
            <span class="role-badge" style="text-transform: capitalize;">{{ Auth::user()->role }}</span>
          </div>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" style="border-radius: 12px; padding: 0.5rem;">
            <li>
              <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}" style="border-radius: 8px; padding: 0.5rem 1rem;">
                <i class="bi bi-person text-muted"></i> Profil
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <button class="dropdown-item d-flex align-items-center gap-2 text-danger" 
                data-bs-toggle="modal" data-bs-target="#logoutModal" style="border-radius: 8px; padding: 0.5rem 1rem;">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
            </li>
          </ul>
        </div>
      @endauth

      <button id="btn-theme" title="Ganti Tema" class="ms-lg-2 mt-3 mt-lg-0">
        <i class="bi bi-moon-stars-fill" id="theme-icon"></i>
        <span id="theme-label" class="d-lg-none ms-2">Mode Gelap</span>
      </button>
    </div>
  </div>
</nav>
