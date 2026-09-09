<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kirish | OlisHudud</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at 10% 20%, #e0e7ff 0%, #f8fafc 60%, #eef2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 440px;
            padding: 2.5rem;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 1rem;
            box-shadow: 0 6px 15px rgba(79, 70, 229, 0.35);
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .btn-auth {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.85rem 1.5rem;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
            transition: all 0.3s;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
            color: white;
        }
    </style>
</head>

<body>

<div class="auth-card">
    <div class="text-center mb-4">
        <a href="/" class="text-decoration-none">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">OlisHudud</h4>
        </a>
        <p class="text-muted small">Tizimga kirish uchun ma'lumotlaringizni kiriting</p>
    </div>

    <!-- Xabarlar -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 small">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 small">
            <i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-3 border-0 small">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email manzili</label>
            <div class="input-group">
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="pochta@misol.uz" 
                       value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label small fw-bold text-muted mb-0">Parol</label>
            </div>
            <input type="password" name="password" id="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   placeholder="••••••••" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check small">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted" for="remember">Eslab qolish</label>
            </div>
        </div>

        <button type="submit" class="btn btn-auth w-100 mb-3">
            Kirish <i class="fas fa-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="text-center pt-3 border-top">
        <span class="text-muted small">Hisobingiz yo‘qmi?</span>
        <a href="/register" class="text-primary small fw-bold text-decoration-none ms-1">Ro'yxatdan o'tish</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>