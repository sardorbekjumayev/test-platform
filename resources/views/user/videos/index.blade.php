<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video darslar | OlisHudud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --light: #f8fafc;
            --border: #e2e8f0;
        }
        body {
            background: var(--light);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 1rem 0;
        }
        .user-avatar {
            width: 42px; height: 42px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            padding: 4rem 0;
            text-align: center;
            margin-bottom: 3rem;
        }
        .video-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            height: 100%;
        }
        .video-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(99,102,241,0.25);
        }
        .video-thumbnail {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem 1.5rem 0 0;
        }
        .video-thumbnail img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: all 0.4s;
        }
        .video-card:hover .video-thumbnail img {
            transform: scale(1.08);
        }
        .play-icon {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #ef4444;
            opacity: 0;
            transition: all 0.4s;
            backdrop-filter: blur(10px);
        }
        .video-card:hover .play-icon {
            opacity: 1;
        }
        .video-info {
            padding: 1.5rem;
        }
        .subject-badge {
            background: var(--primary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .btn-watch {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 600;
        }
        .btn-watch:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(239,68,68,0.4);
        }
    </style>

    <style>
.video-card {
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0 !important;
}
.video-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
}
.video-trigger {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.video-trigger:hover .fa-play {
    transform: scale(1.2);
}
.cursor-pointer { cursor: pointer; }
</style>
</head>
<body>

<!-- Navbar (sizning bosh sahifadagi bilan bir xil) -->
<nav class="navbar sticky-top">
    <div class="container-fluid px-4">
        <a href="/" class="navbar-brand fw-bold text-primary fs-4">OlisHudud</a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-success d-none d-sm-inline-block">
                Bosh Sahifa
            </a>
            <a href="{{ route('documents.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                Hujjatlar
            </a>
            <div class="dropdown">
<a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background={{ substr(md5(Auth::user()->id ?? '1'), 0, 6) }}&color=fff&bold=true&rounded=true&size=80" 
         alt="Avatar" 
         class="rounded-circle me-3" 
         width="42" height="42" 
         style="object-fit: cover;">

    <div class="d-none d-md-block">
        <div class="fw-semibold">{{ auth()->user()->name ?? 'Foydalanuvchi' }}</div>
        <small class="text-muted">O'quvchi</small>
    </div>
</a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="#">ID raqam: {{ auth()->user()->id }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#">Chiqish</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Sarlavha -->
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Video darslar</h1>
        <p class="lead opacity-90">Eng yaxshi o‘qituvchilarning darslari – bepul va sifatli</p>
    </div>
</div>

<div class="container pb-5">

    <!-- Video kartalar -->
    <div class="row g-4">

        <!-- Video 1 -->
@foreach($videos as $video)
<div class="col-md-6 col-lg-4 mb-4">
    <div class="card shadow-sm rounded-4 overflow-hidden h-100">

        <!-- To‘g‘ridan-to‘g‘ri ishlaydigan iframe (lazy load bilan) -->
        <div class="ratio ratio-16x9">
            <iframe 
                data-src="https://www.youtube.com/embed/{{ preg_replace('/^.*(?:v=|youtu\.be\/|embed\/)([^?&\"\'>\s]+).*$/', '$1', $video->url) }}?autoplay=1&rel=0"
                class="lazy-iframe w-100 h-100 border-0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy">
            </iframe>
        </div>

        <div class="p-4">
            <span class="badge bg-primary">{{ $video->subject->name }}</span>
            <h5 class="mt-3 fw-bold">{{ $video->title }}</h5>
            <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-danger btn-sm mt-2">
                YouTube'da ochish
            </a>
        </div>
    </div>
</div>
@endforeach
        <!-- Yana qo‘shishingiz mumkin... -->

            <!-- Mobil uchun natijalar tugmasi -->
    <div class="text-center mt-5 d-sm-none">

        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg">
            Bosh Sahifa
        </a>

        <a href="{{ route('documents.index') }}" class="btn btn-success btn-lg">
            Hujjatlar
        </a>
    </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Faqat ko‘ringan iframe’larni yuklaymiz (tezlik uchun)
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.lazy-iframe').forEach(iframe => {
        if (iframe.dataset.src) {
            iframe.src = iframe.dataset.src;
        }
    });
});
</script>
</body>
</html>