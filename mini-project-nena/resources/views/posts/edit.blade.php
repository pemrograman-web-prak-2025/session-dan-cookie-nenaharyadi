<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">
</head>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4">Edit Postingan</h3>

        <form method="POST" action="/posts/{{ $post->id_post }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label>Isi Postingan</label>
                <textarea name="body" rows="5" class="form-control" required>{{ $post->body }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Perubahan</button>
            <a href="/dashboard" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
</body>
</html>
