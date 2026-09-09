<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mening test natijalarim | OlisHudud</title>

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

        .result-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.25rem;
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .result-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .progress {
            height: 8px;
            border-radius: 50px;
            background: #e2e8f0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="user-nav sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5">
            <div class="p-2 rounded-3 text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                <i class="fas fa-arrow-left"></i>
            </div>
            <span>Bosh sahifaga qaytish</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                <i class="fas fa-user-graduate me-1 text-primary"></i> {{ auth()->user()->name }}
            </span>
        </div>
    </div>
</nav>

<div class="container py-5" style="max-width: 900px;">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Mening test natijalarim</h2>
        <p class="text-muted">Barcha topshirilgan testlar tarixi va ularning batafsil tahlili</p>
    </div>

    @forelse ($results as $result)
        @php
            $isCompleted = $result->score !== null;
            $score = $isCompleted ? $result->score : 0;
            $totalQuestions = $result->questions()->count() ?: 20;
            $percentage = $isCompleted ? round(($score / $totalQuestions) * 100, 1) : 0;

            if ($percentage >= 80) {
                $statusBadge = 'bg-success-subtle text-success border border-success-subtle';
                $progressBar = 'bg-success';
                $statusText = 'A\'lo natija';
            } elseif ($percentage >= 60) {
                $statusBadge = 'bg-warning-subtle text-warning border border-warning-subtle';
                $progressBar = 'bg-warning';
                $statusText = 'Yaxshi natija';
            } else {
                $statusBadge = 'bg-danger-subtle text-danger border border-danger-subtle';
                $progressBar = 'bg-danger';
                $statusText = 'Qayta tayyorgarlik kerak';
            }
        @endphp

        <div class="result-card p-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-3">
                <div>
                    <h5 class="fw-bold mb-1 text-dark">{{ $result->subject->name ?? 'Fan' }}</h5>
                    <small class="text-muted">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $result->created_at->format('d.m.Y H:i') }} da topshirilgan
                    </small>
                </div>

                @if($isCompleted)
                    <div class="text-sm-end">
                        <span class="fs-4 fw-bold text-primary">{{ $score }}</span>
                        <span class="text-muted fs-6">/ {{ $totalQuestions }} ball</span>
                        <div>
                            <span class="badge {{ $statusBadge }} rounded-pill px-3 py-1">{{ $statusText }} ({{ $percentage }}%)</span>
                        </div>
                    </div>
                @else
                    <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill">
                        Tugallanmagan
                    </span>
                @endif
            </div>

            @if($isCompleted)
                <div class="progress mb-3">
                    <div class="progress-bar {{ $progressBar }}" style="width: {{ $percentage }}%"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2">
                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $result->district }}</small>
                    <a href="{{ route('results.show', $result->id) }}" class="btn btn-sm btn-primary rounded-pill px-4">
                        Tahlilni ko'rish <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            @else
                <div class="d-flex justify-content-end pt-2">
                    <a href="{{ route('user.test.show', $result->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                        Davom ettirish <i class="fas fa-play ms-1"></i>
                    </a>
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-5">
            <div class="p-4 rounded-circle bg-light d-inline-flex mb-3">
                <i class="fas fa-clipboard-list fa-3x text-muted opacity-50"></i>
            </div>
            <h5 class="fw-bold">Hozircha natijalar yo'q</h5>
            <p class="text-muted small mb-4">Siz hali birorta ham fan bo'yicha test topshirmagansiz.</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary rounded-pill px-4">
                Test boshlash
            </a>
        </div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>