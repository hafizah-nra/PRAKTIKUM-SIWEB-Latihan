<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Cibaduyut Shoes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

    <div class="container d-flex align-items-center justify-content-center vh-100">

        <div class="card bg-secondary p-4" style="width: 400px;">
            <h3 class="text-center mb-4">Login</h3>

            @if (session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.proses') }}">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control"
                        value="{{ request()->cookie('username') ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input">
                    <label class="form-check-label">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-warning w-100">
                    Login
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-white">Kembali ke Beranda</a>
                </div>

            </form>
        </div>

    </div>

</body>

</html>
