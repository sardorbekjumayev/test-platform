<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natija tahlili — {{ $testInstance->subject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem 0;
        }
        .container { max-width: 1000px; }
        .result-card {
            background: white;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0,0,0,0.25);
        }
        .header {
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            position: relative;
        }
        .header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.1);
            transform: skewY(-6deg);
        }
        .score-circle {
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            border: 8px solid rgba(255,255,255,0.3);
            font-weight: 900;
        }
        .score-big { font-size: 4rem; line-height: 1; }
        .question-item {
            background: #f8fafc;
            border-radius: 1.5rem;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            border-left: 8px solid;
            position: relative;
            transition: all 0.3s ease;
        }
        .question-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .question-item.correct {
            border-left-color: #10b981;
            background: linear-gradient(90deg, #f0fdf4 0%, #ecfdf5 100%);
        }
        .question-item.wrong {
            border-left-color: #ef4444;
            background: linear-gradient(90deg, #fef2f2 0%, #fee2e2 100%);
        }
        .icon {
            width: 60px; height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            flex-shrink: 0;
        }
        .btn-home {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 10px 30px rgba(99,102,241,0.4);
            text-decoration: none;
            display: inline-block;
        }
        .btn-home:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(99,102,241,0.5);
            color: white;
        }
    </style>
</head>
<body>

@php
    $totalQuestions = $questions->count() > 0 ? $questions->count() : 1;
    $percentage = round(($testInstance->score / $totalQuestions) * 100, 1);
@endphp

<div class="container">
    <div class="result-card">

        <!-- Umumiy natija -->
        <div class="header position-relative" style="background: linear-gradient(135deg,
            {{ $percentage >= 80 ? '#10b981' : ($percentage >= 60 ? '#f59e0b' : '#ef4444') }},
            {{ $percentage >= 80 ? '#34d399' : ($percentage >= 60 ? '#fbbf24' : '#f87171') }});">
            <div class="score-circle">
                <div class="score-big">{{ $testInstance->score }}</div>
                <div style="font-size: 1.4rem;">/ {{ $totalQuestions }}</div>
            </div>
            <h1 class="display-5 fw-bold mb-2">
                {{ $testInstance->subject->name }}
            </h1>
            <p class="lead opacity-90">
                {{ $testInstance->created_at->format('d.m.Y H:i') }} da topshirilgan
            </p>
            <div class="badge bg-white text-dark fs-5 px-4 py-2 rounded-pill">
                {{ $percentage }}% muvaffaqiyat
            </div>
        </div>

        <!-- Savollar tahlili -->
        <div class="p-4 p-md-5">
            <h3 class="text-center mb-5 text-primary fw-bold">
                Javoblar tahlili ({{ $questions->count() }} ta savol)
            </h3>

            <div class="row g-4">
                @foreach($questions as $index => $q)
                @php
                    $isMultiple = $q->quiz && $q->quiz->isMultiple();
                    $correctAnswers = $q->quiz ? $q->quiz->correct_answers : [];
                    $userAnswers = $q->user_answers;
                @endphp
                <div class="col-lg-6">
                    <div class="question-item {{ $q->is_correct ? 'correct' : 'wrong' }}"
                         style="animation-delay: {{ $index * 0.05 }}s;">
                        <div class="d-flex align-items-start gap-3">
                            <!-- Ikonka -->
                            <div class="icon {{ $q->is_correct ? 'bg-success' : 'bg-danger' }}">
                                <i class="fas {{ $q->is_correct ? 'fa-check' : 'fa-times' }}"></i>
                            </div>

                            <div class="flex-grow-1">
                                <strong class="d-block mb-2">
                                    {{ $loop->iteration }}. {{ $q->quiz->quiz ?? 'Savol' }}
                                </strong>

                                @if($isMultiple)
                                    <span class="badge mb-2 text-white" style="background-color: #7c3aed;">
                                        <i class="fas fa-check-double me-1"></i> Ko'p tanlovli
                                    </span>
                                @endif

                                <div class="row g-2 mb-2">
                                    <div class="col-12">
                                        <small class="text-muted d-block">To‘g‘ri javob(lar):</small>
                                        <span class="fw-bold text-success">
                                            @if(!empty($correctAnswers))
                                                {{ implode(', ', $correctAnswers) }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted d-block">Sizning javobingiz:</small>
                                        <span class="fw-bold {{ $q->is_correct ? 'text-success' : 'text-danger' }}">
                                            @if(!empty($userAnswers))
                                                {{ implode(', ', $userAnswers) }}
                                            @else
                                                — (javob berilmagan)
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                @if(!$q->is_correct && !empty($userAnswers))
                                <div class="mt-2 p-2 bg-white rounded-3 border">
                                    <small class="text-danger">
                                        <i class="fas fa-exclamation-circle me-1"></i> Xato javob berilgan
                                    </small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Orqaga -->
            <div class="text-center mt-5">
                <a href="{{ route('results.index') }}" class="btn btn-home">
                    <i class="fas fa-arrow-left me-2"></i> Barcha natijalarga qaytish
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Animatsiya kirish
document.querySelectorAll('.question-item').forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(20px)';
    setTimeout(() => {
        item.style.transition = 'all 0.6s ease';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
    }, 100);
});
</script>
</body>
</html>