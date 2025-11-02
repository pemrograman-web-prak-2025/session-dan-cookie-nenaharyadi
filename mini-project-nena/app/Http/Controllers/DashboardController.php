<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            transition: all 0.3s ease;
        }

        .card-post {
            background-color: #ffffff;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 1rem;
            padding: 1.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* 🌙 DARK MODE */
        .dark-mode {
            background-color: #121212 !important;
            color: #f1f1f1 !important;
        }

        .dark-mode .card-post {
            background-color: #1e1e1e !important;
            color: #ddd;
            box-shadow: 0 4px 6px rgba(255,255,255,0.05);
        }

        .dark-mode .btn-outline-secondary {
            color: #f1f1f1;
            border-color: #f1f1f1;
        }

        .dark-mode .btn-outline-secondary:hover {
            background-color: #f1f1f1;
            color: #121212;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Postingan Saya</h3>
        <div>
            <button id="toggle-mode" class="btn btn-outline-secondary fw-semibold me-2">🌙 Dark Mode</button>
            <a href="/posts/create" class="btn btn-primary fw-semibold">+ Buat Postingan Baru</a>
            <a href="/logout" class="btn btn-outline-danger fw-semibold">Logout</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($posts->isEmpty())
        <div class="alert alert-info">Belum ada postingan. Yuk, buat satu!</div>
    @else
        @foreach($posts as $post)
            @php
                $waktuDibuat = \Carbon\Carbon::parse($post->created_at);
                $waktuDiupdate = \Carbon\Carbon::parse($post->updated_at);
            @endphp
            <div class="card-post">
                <h5 class="fw-bold">{{ $post->title }}</h5>
                <p>{{ $post->body }}</p>
                <small class="text-muted">
                    @if($waktuDiupdate->gt($waktuDibuat))
                        Diperbarui: {{ $waktuDiupdate->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                    @else
                        Dibuat: {{ $waktuDibuat->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                    @endif
                </small>

                <div class="mt-3">
                    <a href="/posts/{{ $post->id_post }}/edit" class="btn btn-sm btn-warning fw-semibold">Edit</a>
                    <form action="/posts/{{ $post->id_post }}" method="POST" class="d-inline ms-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger fw-semibold"
                                onclick="return confirm('Yakin mau hapus postingan ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>

<!-- SCRIPT DARK MODE -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const btn = document.getElementById("toggle-mode");

    // Baca mode terakhir dari cookies
    const currentMode = getCookie("theme") || "light";
    applyTheme(currentMode);

    btn.addEventListener("click", function() {
        const newMode = body.classList.contains("dark-mode") ? "light" : "dark";
        applyTheme(newMode);
        setCookie("theme", newMode, 365);
    });

    function applyTheme(mode) {
        if (mode === "dark") {
            body.classList.add("dark-mode");
            btn.textContent = "☀️ Light Mode";
        } else {
            body.classList.remove("dark-mode");
            btn.textContent = "🌙 Dark Mode";
        }
    }

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days*24*60*60*1000).toUTCString();
        document.cookie = `${name}=${value}; expires=${expires}; path=/`;
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
});
</script>
</body>
</html>