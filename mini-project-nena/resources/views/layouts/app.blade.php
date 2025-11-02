<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Saya')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tema -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body border-bottom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">MyBlog</a>

            <div class="d-flex align-items-center">
                <button id="themeToggle" class="btn btn-outline-secondary me-3">
                    🌙 / ☀️
                </button>

                @if(session()->has('user'))
                    <a href="/dashboard" class="btn btn-primary me-2">Dashboard</a>
                    <a href="/logout" class="btn btn-outline-danger">Logout</a>
                @else
                    <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a href="/register" class="btn btn-primary">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <main class="container mb-5">
        @yield('content')
    </main>

    <footer class="text-center py-3 border-top">
        <small>© 2025 MyBlog | Semua hak cipta dilindungi</small>
    </footer>

    <script>
        const html = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme') || 'light';

        // Set tema awal
        html.setAttribute('data-theme', savedTheme);

        // Ubah ikon sesuai tema
        toggleBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';

        toggleBtn.addEventListener('click', () => {
            const newTheme = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            toggleBtn.textContent = newTheme === 'dark' ? '☀️' : '🌙';
        });
    </script>
</body>
</html>