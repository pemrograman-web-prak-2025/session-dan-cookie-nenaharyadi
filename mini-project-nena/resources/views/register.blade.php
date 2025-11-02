<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - Aplikasi Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-pen-nib"></i>
                Aplikasi Postingan
            </a>
            
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
        <div class="welcome-container" style="max-width: 550px;">
            <h1 class="mb-4 fw-bold">Buat Akun Baru</h1>
            <p class="lead mb-4">Daftar untuk mulai membuat postingan Anda.</p>

            <form action="/register" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="Nama Lengkap Anda" value="{{ old('name') }}" required>
                    <label for="name">Nama Lengkap</label>
                    @error('name')
                        <div class="invalid-feedback text-start">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                    <label for="email">Alamat Email</label>
                    @error('email')
                        <div class="invalid-feedback text-start">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-floating mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Buat Password" required>
                    <label for="password">Password (min. 5 karakter)</label>
                    @error('password')
                        <div class="invalid-feedback text-start">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </button>

                <p class="mt-4 text-muted">
                    Sudah punya akun? <a href="/login" style="color: var(--tosca-dark); font-weight: 600;">Login di sini</a>
                </p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
