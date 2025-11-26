{{-- resources/views/results/index.blade.php --}}
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mening natijalarim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem 0;
        }
        .page-title {
            text-align: center;
            color: white;
            margin-bottom: 2.5rem;
        }
        .results-container {
            max-width: 850px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .result-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            margin-bottom: 1.5rem;
            box-shadow: 0 12px 35px rgba(0,0,0,0.18);
            transition: all 0.35s ease;
        }
        .result-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(99,102,241,0.3);
        }
        .card-header {
            padding: 1.5rem 2rem;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .score-display {
            font-size: 2.6rem;
            font-weight: 900;
        }
        .subject-name {
            font-size: 1.4rem;
        }
        .card-body {
            padding: 1.5rem 2rem;
            background: #f8fafc;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-size: 1rem;
        }
        .label {
            color: #64748b;
        }
        .value {
            font-weight: 600;
        }
        .progress {
            height: 14px;
            border-radius: 50px;
            background: #e2e8f0;
            overflow: hidden;
        }
        .progress-bar {
            border-radius: 50px;
            transition: width 1.2s ease;
        }
        .null-score {
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <h1 class="page-title display-5 fw-bold">
        Mening natijalarim
    </h1>

    <div class="results-container">

@foreach ($results as $result)
    @php
        $isCompleted = $result->score !== null;
        $score = $isCompleted ? $result->score : 0;
        $totalQuestions = 20; // agar boshqa bo‘lsa o‘zgartiring
        $percentage = $isCompleted ? round(($score / $totalQuestions) * 100, 1) : 0;

        // Rangni ballga qarab belgilash
        if ($percentage >= 80) {
            $headerColor = 'linear-gradient(135deg, #10b981, #34d399)'; // yashil
            $progressColor = 'bg-success';
        } elseif ($percentage >= 60) {
            $headerColor = 'linear-gradient(135deg, #f59e0b, #fbbf24)'; // sariq
            $progressColor = 'bg-warning';
        } else {
            $headerColor = 'linear-gradient(135deg, #ef4444, #f87171)'; // qizil
            $progressColor = 'bg-danger';
        }
    @endphp

    <div class="result-card">
        @if (!$isCompleted)
            <!-- Yakunlanmagan test -->
            <div class="card-header" style="background: linear-gradient(135deg, #94a3b8, #cbd5e1);">
                <div class="subject-name">{{ $result->subject->name }}</div>
                <div class="score-display null-score">Test tugallanmagan</div>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="label">Boshlangan vaqti:</span>
                    <span class="value">{{ $result->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Tugagan vaqti:</span>
                    <span class="value">—</span>
                </div>
                <div class="info-row">
                    <span class="label">Holati:</span>
                    <span class="value text-muted">Test boshlangan, lekin yakunlanmagan</span>
                </div>
                <div class="mt-3 text-end">
                    <a href="" 
                       class="btn btn-outline-primary btn-sm rounded-pill px-4">
                        Davom ettirish
                    </a>
                </div>
            </div>
        @else
            <!-- Tugallangan test -->
            <div class="card-header" style="background: {{ $headerColor }};">
                <div class="subject-name">{{ $result->subject->name }}</div>
                <div class="score-display">{{ $score }}/{{ $totalQuestions }}</div>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="label">Boshlangan vaqti:</span>
                    <span class="value">{{ $result->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Tugallangan vaqti:</span>
                    <span class="value">{{ $result->expires_at?->format('d.m.Y H:i') ?? $result->updated_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Muvaffaqiyat:</span>
                    <span class="value fw-bold {{ $percentage >= 80 ? 'text-success' : ($percentage >= 60 ? 'text-warning' : 'text-danger') }}">
                        {{ $percentage }}%
                    </span>
                </div>
                <div class="progress mt-3">
                    <div class="progress-bar {{ $progressColor }}" style="width: {{ $percentage }}%"></div>
                </div>
                <div class="mt-3 text-end">
<a href="{{ route('results.show', $result->id) }}" 
   class="btn btn-outline-primary btn-sm rounded-pill px-4">
    Batafsil tahlil
</a>
                </div>
            </div>
        @endif
    </div>
@endforeach



  

    </div>
</div>

</body>
</html>