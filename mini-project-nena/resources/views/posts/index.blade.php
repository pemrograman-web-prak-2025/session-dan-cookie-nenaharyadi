<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">
</head>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/dashboard">Mini Blog</a>
        <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Postingan Saya</h3>
        <a href="/posts/create" class="btn btn-success">+ Tambah Postingan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($posts as $post)
        <div class="card mb-3 p-3">
            <h5>{{ $post->title }}</h5>
            <p>{{ $post->content }}</p>
            <small class="text-muted">Dibuat: {{ $post->created_at }}</small>
        </div>
    @empty
        <p class="text-muted">Belum ada postingan.</p>
    @endforelse
</div>
</body>
</html>
