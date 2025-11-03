<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-pen-nib"></i>Dashboard Saya
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav-buttons ms-auto d-flex gap-2 align-items-center">
                    
                    <button id="toggle-mode" class="btn btn-toggle-mode" title="Ganti Mode">
                        <i class="fas fa-moon"></i>
                    </button>
                    
                    <a href="/posts/create" class="btn btn-login">
                        <i class="fas fa-plus me-1"></i>Buat Postingan
                    </a>
                    <a href="/logout" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <h3 class="fw-bold mb-4" style="color: var(--tosca-dark);">Postingan Saya</h3>

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
                            <h5>{{ $post->title }}</h5>
                            <p>{{ $post->body }}</p>
                            
                            <small class="text-muted">
                                @if($waktuDiupdate->gt($waktuDibuat))
                                    Diperbarui: {{ $waktuDiupdate->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                @else
                                    Dibuat: {{ $waktuDibuat->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
                                @endif
                            </small>
                            
                            <div class="mt-3">
                                <a href="/posts/{{ $post->id_post }}/edit" class="btn btn-sm btn-warning fw-semibold">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                
                                <form action="/posts/{{ $post->id_post }}" method="POST" class="d-inline ms-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-semibold"
                                            onclick="return confirm('Yakin mau hapus postingan ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div> 
        </div> 
    </div> 

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const body = document.body;
        const btn = document.getElementById("toggle-mode");
        const icon = btn.querySelector("i");

        // 1. Baca mode terakhir dari cookie
        const currentMode = getCookie("theme") || "light";
        applyTheme(currentMode);

        // 2. Tambahkan event listener ke tombol
        btn.addEventListener("click", function() {
            const newMode = body.classList.contains("dark-mode") ? "light" : "dark";
            applyTheme(newMode);
            // 3. Simpan pilihan ke cookie
            setCookie("theme", newMode, 365);
        });

        // Fungsi untuk menerapkan tema
        function applyTheme(mode) {
            if (mode === "dark") {
                body.classList.add("dark-mode");
                icon.classList.remove("fa-moon");
                icon.classList.add("fa-sun");
            } else {
                body.classList.remove("dark-mode");
                icon.classList.remove("fa-sun");
                icon.classList.add("fa-moon");
            }
        }

        // Fungsi helper untuk menyimpan cookie
        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days*24*60*60*1000).toUTCString();
            document.cookie = `${name}=${value}; expires=${expires}; path=/`;
        }

        // Fungsi helper untuk membaca cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }
    });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>