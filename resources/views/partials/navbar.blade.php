{{-- resources/views/partials/navbar.blade.php --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 sticky-top">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            Toko Sepatu
        </a>

        {{-- Button Mobile --}}
        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu Navbar --}}
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active"
                        href="{{ route('products') }}">
                        Produk
                    </a>
                </li>

            </ul>
        </div>

        {{-- Menu Kanan --}}
        <div class="collapse navbar-collapse justify-content-end">

            {{-- Wishlist --}}
            <button class="btn btn-outline-warning btn-sm me-2"
                data-bs-toggle="modal"
                data-bs-target="#wishlistModal"
                onclick="tampilkanWishlist()">

                ⭐ Wishlist (<span id="wishlist-count">0</span>)
            </button>

            {{-- Dark Mode --}}
            <button id="btn-theme"
                class="btn btn-outline-light btn-sm me-2">

                Mode Gelap
            </button>

            {{-- Jika User Login --}}
            @auth

                <span class="text-white me-3">
                    {{ Auth::user()->name }}
                </span>

                {{-- Logout wajib method POST --}}
                <form action="{{ route('logout') }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    <button type="submit"
                        class="btn btn-danger btn-sm">

                        Logout
                    </button>

                </form>

            @endauth

            {{-- Jika Belum Login --}}
            @guest

                <a href="{{ route('login') }}"
                    class="btn btn-warning btn-sm me-2">

                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="btn btn-outline-light btn-sm">

                    Register
                </a>

            @endguest

        </div>

    </div>
</nav>