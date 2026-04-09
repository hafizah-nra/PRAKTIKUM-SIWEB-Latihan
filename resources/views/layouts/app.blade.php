<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="brand">
            <strong>E-Commerce</strong>
        </div>
        <div class="navbar-right">
            @auth
                <span style="color: white;">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
                
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; margin-left: 1rem; cursor: pointer;">Admin Panel</a>
                @else
                    <a href="{{ route('cart.index') }}" class="cart-link">
                        <span style="margin-right: 0.5rem;">🛒</span>
                        Cart
                        @php
                            $cartCount = count(session('cart', []));
                        @endphp
                        @if ($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-error">
                {{ $message }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
