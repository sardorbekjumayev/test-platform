<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'quvchi portali | OlisHudud</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --dark: #0f172a;
            --muted: #64748b;
            --body-bg: #f8fafc;
            --card-border: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--body-bg);
            color: var(--dark);
            min-height: 100vh;
        }

        /* Navbar */
        .user-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--card-border);
            padding: 0.85rem 0;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .nav-btn {
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.5rem 1.1rem;
            border-radius: 50px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .nav-btn-results {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .nav-btn-results:hover {
            background: #059669;
            color: white;
            transform: translateY(-2px);
        }

        .nav-btn-docs {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }
        .nav-btn-docs:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
        }

        .nav-btn-videos {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .nav-btn-videos:hover {
            background: #dc2626;
            color: white;
            transform: translateY(-2px);
        }

        /* Subject Cards */
        .subject-card {
            background: #ffffff;
            border: 1px solid var(--card-border);
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .subject-card:hover {
            transform: translateY(-8px);
            border-color: #cbd5e1;
            box-shadow: 0 20px 35px -5px rgba(79, 70, 229, 0.12);
        }

        .subject-img-wrap {
            height: 140px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
        }

        .subject-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .subject-card:hover .subject-img-wrap img {
            transform: scale(1.05);
        }

        .btn-start-test {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.65rem 1.5rem;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-start-test:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
            color: white;
        }

        .user-avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="user-nav sticky-top">
    <div class="container-fluid px-lg-5 px-3 d-flex justify-content-between align-items-center">
        <a href="/" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span>OlisHudud</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            <!-- Nav buttons -->
            <a href="{{ route('results.index') }}" class="nav-btn nav-btn-results d-none d-md-inline-flex">
                <i class="fas fa-chart-pie"></i> Test natijalari
            </a>
            <a href="{{ route('documents.index') }}" class="nav-btn nav-btn-docs d-none d-md-inline-flex">
                <i class="fas fa-file-alt"></i> Hujjatlar
            </a>
            <a href="{{ route('videos.index') }}" class="nav-btn nav-btn-videos d-none d-md-inline-flex">
                <i class="fas fa-play-circle"></i> Videolar
            </a>

            <!-- User profile dropdown -->
            <div class="dropdown ms-2">
                <button class="btn p-0 border-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <div class="user-avatar-circle">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="d-none d-lg-block text-start">
                        <div class="fw-bold small lh-1">{{ auth()->user()->name ?? 'O‘quvchi' }}</div>
                        <small class="text-muted" style="font-size: 0.7rem;">ID: #{{ auth()->user()->id }}</small>
                    </div>
                    <i class="fas fa-chevron-down small text-muted ms-1" style="font-size: 0.75rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2 p-2">
                    <li class="p-2 border-bottom">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <small class="text-muted">{{ auth()->user()->email }}</small><br>
                        <span class="badge bg-light text-dark border mt-1">{{ auth()->user()->district ?? 'Buxoro' }}</span>
                    </li>
                    <li class="d-md-none mt-2">
                        <a class="dropdown-item rounded-3" href="{{ route('results.index') }}"><i class="fas fa-chart-pie me-2 text-success"></i>Test natijalari</a>
                    </li>
                    <li class="d-md-none">
                        <a class="dropdown-item rounded-3" href="{{ route('documents.index') }}"><i class="fas fa-file-alt me-2 text-primary"></i>Hujjatlar</a>
                    </li>
                    <li class="d-md-none">
                        <a class="dropdown-item rounded-3" href="{{ route('videos.index') }}"><i class="fas fa-play-circle me-2 text-danger"></i>Videolar</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item rounded-3 text-danger d-flex align-items-center gap-2">
                                <i class="fas fa-sign-out-alt"></i> Tizimdan chiqish
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Main Container -->
<div class="container-fluid px-lg-5 px-3 py-4 py-md-5">

    <!-- Welcome banner -->
    <div class="p-4 p-md-5 rounded-4 mb-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%); color: white;">
        <div class="position-relative z-1" style="max-width: 650px;">
            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 mb-2">
                <i class="fas fa-bolt me-1 text-warning"></i> Bilimlarni sinash maydoni
            </span>
            <h1 class="fw-bold mb-2">Fanlar bo‘yicha test sinovlari</h1>
            <p class="text-white text-opacity-75 mb-0">Kerakli fanni tanlang, tayyorgarlik darajangizni baholang va xatolaringiz ustida ishlang.</p>
        </div>
    </div>

    <!-- Subjects Grid -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Barcha fanlar ({{ $subjects_count }} ta)</h4>
    </div>

    <div class="row g-4">
        @forelse($subjects as $subject)
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="subject-card">
                <div class="subject-img-wrap">
                    @if($subject->image)
                        <img src="{{ asset('storage/' . $subject->image) }}" alt="{{ $subject->name }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-white display-5 fw-bold">
                            {{ Str::substr($subject->name, 0, 2) }}
                        </div>
                    @endif
                </div>

                <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                    <div class="mb-3">
                        <h5 class="fw-bold text-dark mb-1">{{ $subject->name }}</h5>
                        <small class="text-muted"><i class="fas fa-tasks me-1 text-primary"></i> 20 ta test savollari</small>
                    </div>

                    <div class="d-flex flex-column gap-2 mt-auto">
                        <a href="{{ route('user.test.start', $subject->id) }}" class="btn btn-start-test">
                            <i class="fas fa-play me-1 small"></i> Testni boshlash
                        </a>
                        <a href="{{ route('documents.index') }}" class="btn btn-sm btn-light border rounded-pill text-muted fw-semibold">
                            <i class="fas fa-info-circle me-1"></i> Qo'llanmalar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center text-muted">
            <i class="fas fa-book-open fa-3x mb-3 opacity-25"></i>
            <h5>Hozircha fanlar mavjud emas</h5>
            <p class="small">Administrator tomonidan tez orada yangi fanlar qo'shiladi.</p>
        </div>
        @endforelse
    </div>

</div>

<!-- Footer -->
<footer class="py-4 border-top bg-white text-center text-muted small mt-5">
    <div class="container">
        <div>&copy; {{ date('Y') }} <strong>OlisHudud</strong> • Buxoro viloyat pedagogik mahorat markazi</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>