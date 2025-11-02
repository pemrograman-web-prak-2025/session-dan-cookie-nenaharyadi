<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Mini-Blog : Website untuk menulis pengalaman anda dengan sistem yang efisien dan aman. </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-pen-nib"></i>MiniBlog</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav-buttons ms-auto d-flex gap-2">
                    <a href="/login" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                    <a href="/register" class="btn btn-register">
                        <i class="fas fa-user-plus me-1"></i>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="welcome-container">
            <h1 class="mb-4 fw-bold">👋Selamat Datang</h1>
            <p class="lead mb-5">Aplikasi sederhana untuk membuat dan mengelola postingan dengan mudah dan efisien.</p>

            <div class="d-flex justify-content-center gap-3">
                <a href="/login" class="btn btn-primary px-4">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
                <a href="/register" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-user-plus me-2"></i>Register
                </a>
            </div>
        </div>
        
        <div class="features-section">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col">
                        <h2 class="fw-bold" style="color: var(--tosca-dark);">Fitur Unggulan</h2>
                        <p class="lead">Nikmati pengalaman menulis dan berbagi yang lebih baik</p>
                    </div>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <h4 class="feature-title">Editor Canggih</h4>
                            <p class="feature-text">Buat postingan dengan editor teks yang lengkap dan mudah digunakan dengan format yang beragam.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 class="feature-title">Aman & Pribadi</h4>
                            <p class="feature-text">Postingan Anda hanya bisa dilihat dan diedit oleh Anda sendiri. Keamanan data terjamin.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h4 class="feature-title">Cepat & Ringan</h4>
                            <p class="feature-text">Aplikasi ini berjalan cepat dan efisien tanpa membebani perangkat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="container">&copy; 2025 Mini Project - MiniBlog</div>
    </footer>

    <div class="wave-decoration">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>