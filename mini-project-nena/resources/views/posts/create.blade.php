<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo-icon.png') }}" type="image/png">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4">Buat Postingan Baru</h3>

        <form method="POST" action="/posts">
            @csrf
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                
                @error('title')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
                </div>

            <div class="mb-3">
                <label>Isi Postingan</label>
                <textarea name="body" rows="5" class="form-control" required>{{ old('body') }}</textarea>

                @error('body')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
                </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/dashboard" class="btn btn-secondary">Batal</a> </form>
    </div>
</div>
</body>
</html>