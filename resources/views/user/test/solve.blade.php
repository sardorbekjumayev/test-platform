<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test | {{ $testInstance->subject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --success: #10b981;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
        }
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .test-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .test-card {
            background: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .test-header {
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .test-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        .timer {
            font-size: 2rem;
            font-weight: bold;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            display: inline-block;
            backdrop-filter: blur(10px);
        }
        .progress {
            height: 12px;
            border-radius: 50px;
            background: rgba(255,255,255,0.3);
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(90deg, #10b981, #34d399);
            border-radius: 50px;
        }
        .question-card {
            padding: 2rem;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.3s;
        }
        .question-card:last-child { border-bottom: none; }
        .question-number {
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            font-weight: bold;
            margin-right: 1rem;
        }
        .option-label {
            display: block;
            padding: 1.2rem 1.5rem;
            margin: 0.75rem 0;
            border: 2px solid #e2e8f0;
            border-radius: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        .option-label:hover {
            border-color: var(--primary);
            background: #eef2ff;
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(99,102,241,0.15);
        }
        .option-label input[type="radio"] {
            margin-right: 1rem;
            transform: scale(1.3);
        }
        .option-label:has(input:checked) {
            background: #eef2ff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.2);
        }
        .btn-finish {
            background: linear-gradient(135deg, #10b981, #34d399);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            box-shadow: 0 10px 30px rgba(16,185,129,0.4);
            transition: all 0.3s;
        }
        .btn-finish:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(16,185,129,0.5);
        }
        @media (max-width: 768px) {
            .test-title { font-size: 1.6rem; }
            .timer { font-size: 1.5rem; }
            .question-card { padding: 1.5rem; }
        }
    </style>
</head>
<body>
<div class="test-container">
    <div class="test-card">
 
        <!-- Header -->
        <div class="test-header">
            <h1 class="test-title">
                <i class="fas fa-graduation-cap me-3"></i>
                {{ $testInstance->subject->name }}
            </h1>
            <div class="timer" id="countdown">30:00</div>
            <div class="mt-3">
                <div class="progress">
                    <div class="progress-bar" id="progressBar" style="width: 0%"></div>
                </div>
                <small class="d-block mt-2 opacity-90">Savollar: {{ $questions->count() }}</small>
            </div>
        </div>

        <!-- Questions Form -->
        <form action="{{ route('user.test.finish', $testInstance->id) }}" method="POST" id="testForm">
            @csrf
            <div class="p-4">
                @foreach($questions as $item)
                <div class="question-card d-flex">
                    <div class="question-number flex-shrink-0">
                        {{ $loop->iteration }}
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-4 fw-bold">{{ $item->quiz->quiz }}</h5>
                        <div class="options">
                            @foreach([$item->quiz->option1, $item->quiz->option2, $item->quiz->option3, $item->quiz->option4] as $index => $option)
                                @if($option)
                                <label class="option-label">
                                    <input type="radio" 
                                           name="answer_{{ $item->id }}" 
                                           value="{{ $option }}" 
                                           required>
                                    <span class="ms-2">{{ chr(65 + $index) }}. {{ $option }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-finish">
                        Testni yakunlash
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>



    // PHP dan kelgan vaqt (soniyalarda)
let totalTime = Math.floor({{ $remainingSeconds }});  // PHP → JS butun son
let remaining = totalTime;

function formatTime(seconds) {
    seconds = Math.max(0, Math.floor(seconds)); // float emas → int, manfiy bo‘lmasin

    const m = Math.floor(seconds / 60);
    const s = seconds % 60;

    return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
}
    function startTimer() {
        const timer = document.getElementById('countdown');
        timer.textContent = formatTime(remaining);

        const interval = setInterval(() => {
            remaining--;

            if (remaining <= 0) {
                clearInterval(interval);
            }

            timer.textContent = formatTime(remaining);
        }, 1000);
    }

    startTimer();





// Savol javoblarini hisoblash (progress bar uchun)
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', () => {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const questionProgress = (answered / totalQuestions) * 100;
        progressBar.style.width = Math.max(progressBar.style.width.replace('%',''), questionProgress) + '%';
    });
});
</script>
</body>
</html>