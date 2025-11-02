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
                <div class="nav-buttons ms-auto d-flex gap-2">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>