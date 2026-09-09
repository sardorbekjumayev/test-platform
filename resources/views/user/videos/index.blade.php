<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video darslar | OlisHudud</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
        }

        .user-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 0;
        }

        .video-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .video-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(220, 38, 38, 0.12);
            border-color: #fca5a5;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="user-nav sticky-top">
    <div class="container-fluid px-lg-5 px-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5">
            <div class="p-2 rounded-3 text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                <i class="fas fa-arrow-left"></i>
            </div>
            <span>Bosh sahifaga qaytish</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('documents.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                <i class="fas fa-file-alt me-1"></i> Hujjatlar
            </a>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill d-none d-sm-inline-block">
                {{ auth()->user()->name }}
            </span>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Video darslar kutubxonasi</h2>
        <p class="text-muted">Eng sara ustozlarning mavzulashtirilgan video tushuntirishlari</p>
    </div>

    <!-- Video kartalar -->
    <div class="row g-4">
        @forelse($videos as $video)
        <div class="col-md-6 col-lg-4">
            <div class="video-card">
                <div class="ratio ratio-16x9 bg-dark">
                    @php
                        preg_match('/(?:v=|youtu\.be\/|embed\/)([^?&"\'>\s]+)/', $video->url, $matches);
                        $videoId = $matches[1] ?? '';
                    @endphp
                    @if($videoId)
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $videoId }}" 
                            title="{{ $video->title }}" 
                            allowfullscreen 
                            loading="lazy" 
                            class="border-0 w-100 h-100">
                        </iframe>
                    @else
                        <div class="d-flex align-items-center justify-content-center text-white">
                            <i class="fas fa-video-slash fa-2x"></i>
                        </div>
                    @endif
                </div>

                <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                    <div>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill mb-2">
                            <i class="fas fa-tag me-1"></i> {{ $video->subject->name }}
                        </span>
                        <h6 class="fw-bold text-dark mb-3">{{ $video->title }}</h6>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-auto">
                        <small class="text-muted"><i class="fas fa-clock me-1"></i> {{ $video->created_at ? $video->created_at->format('d.m.Y') : 'Yangi' }}</small>
                        <a href="{{ $video->url }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                            <i class="fab fa-youtube me-1"></i> YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center text-muted">
            <i class="fab fa-youtube fa-4x mb-3 text-danger opacity-25"></i>
            <h5>Hozircha video darslar mavjud emas</h5>
        </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>