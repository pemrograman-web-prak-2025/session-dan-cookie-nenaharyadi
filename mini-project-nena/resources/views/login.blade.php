<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Mini Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">

    <style>
        body { background-color: #f8f9fa; }
        .login-card {
            max-width: 450px;
            margin: 5rem auto;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-radius: 0.75rem;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-card">
        <h3 class="text-center fw-bold mb-4">Login</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
        </form>

        <div class="text-center mt-4">
            <p class="text-muted mb-1">
                Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a>
            </p>

            <p class="text-muted">
                <a href="/">&larr; Kembali ke Beranda (Index)</a>
            </p>
        </div>
    </div>
</div>

<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
