<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natija — {{ $testInstance->subject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --light: #f9fafb;
            --dark: #1e293b;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem 0;
        }
        .result-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .result-card {
            background: white;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.25);
            animation: floatIn 0.9s ease-out;
        }
        @keyframes floatIn {
            from { opacity: 0; transform: translateY(60px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .result-header {
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            color: white;
            background: linear-gradient(135deg,
                @if($testInstance->score >= 26) #10b981, #34d399
                @elseif($testInstance->score >= 20) #f59e0b, #fbbf24
                @else #ef4444, #f87171 @endif
            );
        }
        .result-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,30 L100,100 L0,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        .score-display {
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(12px);
            border: 10px solid rgba(255,255,255,0.3);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            animation: pulse 3s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 15px 35px rgba(0,0,0,0.3); }
            50% { box-shadow: 0 25px 60px rgba(0,0,0,0.4); }
        }
        .score-big {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1;
        }
        .score-total {
            font-size: 1.4rem;
            opacity: 0.9;
        }
        .result-badge {
            display: inline-block;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.4rem;
            background: rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.4);
        }
        .analysis-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin: 2.5rem 0 2rem;
            text-align: center;
        }
        .question-item {
            background: #f8fafc;
            border-radius: 1.5rem;
            padding: 1.8rem;
            margin-bottom: 1.2rem;
            border-left: 8px solid;
            transition: all 0.4s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.6s ease-out forwards;
        }
        @keyframes slideIn {
            to { opacity: 1; transform: translateY(0); }
        }
        .question-item.correct {
            border-left-color: #10b981;
            background: linear-gradient(90deg, #ecfdf5 0%, #f0fdf4 100%);
        }
        .question-item.wrong {
            border-left-color: #ef4444;
            background: linear-gradient(90deg, #fef2f2 0%, #fee2e2 100%);
        }
        .question-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.4rem;
            color: white;
            flex-shrink: 0;
        }
        .answer-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0.8rem 0;
            font-size: 1.1rem;
        }
        .icon-check, .icon-cross {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
        }
        .icon-check { background: #10b981; }
        .icon-cross { background: #ef4444; }
        .btn-home {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 50px;
            padding: 1.2rem 3.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 12px 35px rgba(99,102,241,0.4);
            transition: all 0.4s;
        }
        .btn-home:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(99,102,241,0.5);
        }
        .confetti {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 9999;
        }
    </style>
</head>
<body>

<!-- Konfeti faqat 26+ ball uchun -->
@if($testInstance->score >= 26)
<div class="confetti" id="confetti"></div>
@endif

<div class="result-wrapper">
    <div class="result-card">

        <!-- Natija sarlavhasi -->
        <div class="result-header">
            <div class="score-display">
                <div class="score-big">{{ $testInstance->score }}</div>
                <div class="score-total">/ 30</div>
            </div>

            <h1 class="display-5 fw-bold mb-3">
                @if($testInstance->score >= 28)
                    Sertifikatga loyiq natija!
                @elseif($testInstance->score >= 26)
                    Ajoyib! Siz zo‘rsiz!
                @elseif($testInstance->score >= 22)
                    Juda yaxshi ish!
                @elseif($testInstance->score >= 18)
                    Yaxshi, lekin yaxshiroq bo‘lishi mumkin
                @else
                    Yana urinib ko‘ring!
                @endif
            </h1>

            <div class="result-badge">
                {{ number_format($testInstance->score / 30 * 100, 1) }}% muvaffaqiyat
            </div>
        </div>

        <!-- Javoblar tahlili -->
        <div class="p-5">
            <h2 class="analysis-title">
                Javoblar tahlili
            </h2>

            <div class="row g-4">
                @foreach($details as $index => $item)
                <div class="col-lg-6">
                    <div class="question-item {{ ($item['user_answer'] == $item['quiz']['answer']) ? 'correct' : 'wrong' }}"
                         style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="d-flex align-items-start gap-3">
                            <div class="question-number {{ ($item['user_answer'] == $item['quiz']['answer']) ? 'bg-success' : 'bg-danger' }}">
                                {{ $loop->iteration }}
                            </div>
                            <div class="flex-grow-1">
                                <strong class="d-block mb-3">
                                    {{ Str::limit($item['quiz']['quiz'], 100) }}
                                </strong>

                                <div class="answer-row">
                                            <!-- <i class="fas fa-check-circle text-success fs-4"></i> -->
                                    <div>
                                        <small class="text-muted">To‘g‘ri javob:</small><br>
                                        <span class="fw-bold text-success">{{ $item['quiz']['answer'] }}</span>
                                    </div>
                                </div>

                                <div class="answer-row">
@if($item['user_answer'] == $item['quiz']['answer'])
    
        <i class="fas fa-check-circle text-success fs-4"></i>
    
@else
    
        <i class="fas fa-times-circle text-danger fs-4"></i>
    
@endif
                                    <div>
                                        <small class="text-muted">Sizning javobingiz:</small><br>
                                        <span class="fw-bold {{ ($item['user_answer'] == $item['quiz']['answer']) ? 'text-success' : 'text-danger' }}">
                                            {{ $item['user_answer'] ?? '— (javob berilmagan)' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('subjects.index') }}" class="btn btn-home">
                    Bosh sahifaga qaytish
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Konfeti effekti -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
<script>
    @if($testInstance->score >= 26)
    const duration = 6 * 1000;
    const animationEnd = Date.now() + duration;
    const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

    function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    const interval = setInterval(function() {
        const timeLeft = animationEnd - Date.now();
        if (timeLeft <= 0) return clearInterval(interval);

        const particleCount = 50 * (timeLeft / duration);
        confetti(Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
        }));
        confetti(Object.assign({}, defaults, {
            particleCount,
            origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
        }));
    }, 250);
    @endif
</script>
</body>
</html>