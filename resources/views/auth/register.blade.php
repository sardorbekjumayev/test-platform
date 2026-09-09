<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ro'yxatdan o'tish | OlisHudud</title>

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
            background: radial-gradient(circle at 90% 10%, #e0e7ff 0%, #f8fafc 60%, #eef2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 520px;
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

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
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
        <p class="text-muted small">Yangi hisob yaratish uchun formani to‘ldiring</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3 border-0 small mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <div class="row g-2 mb-3">
            <div class="col-sm-6">
                <label class="form-label small fw-bold text-muted">Ismingiz</label>
                <input type="text" name="fname" class="form-control" 
                       placeholder="Ism" value="{{ old('fname') }}" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label small fw-bold text-muted">Familiyangiz</label>
                <input type="text" name="lname" class="form-control" 
                       placeholder="Familiya" value="{{ old('lname') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Email manzili</label>
            <input type="email" name="email" class="form-control" 
                   placeholder="pochta@misol.uz" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Tuman yoki shahar</label>
            <select name="district" class="form-select" required>
                <option value="" disabled selected>Tanlang...</option>
                <option value="Buxoro shahar">Buxoro shahar</option>
                <option value="Kogon shahar">Kogon shahar</option>
                <option value="Olot tumani">Olot tumani</option>
                <option value="Buxoro tumani">Buxoro tumani</option>
                <option value="Vobkent tumani">Vobkent tumani</option>
                <option value="Gʻijduvon tumani">Gʻijduvon tumani</option>
                <option value="Jondor tumani">Jondor tumani</option>
                <option value="Kogon tumani">Kogon tumani</option>
                <option value="Qorakoʻl tumani">Qorakoʻl tumani</option>
                <option value="Qorovulbozor tumani">Qorovulbozor tumani</option>
                <option value="Peshku tumani">Peshku tumani</option>
                <option value="Romitan tumani">Romitan tumani</option>
                <option value="Shofirkon tumani">Shofirkon tumani</option>
            </select>
        </div>

        <div class="row g-2 mb-4">
            <div class="col-sm-6">
                <label class="form-label small fw-bold text-muted">Parol</label>
                <input type="password" name="password" class="form-control" 
                       placeholder="••••••••" required>
            </div>
            <div class="col-sm-6">
                <label class="form-label small fw-bold text-muted">Parolni tasdiqlang</label>
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn btn-auth w-100 mb-3">
            Ro'yxatdan o'tish <i class="fas fa-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="text-center pt-3 border-top">
        <span class="text-muted small">Hisobingiz bormi?</span>
        <a href="/login" class="text-primary small fw-bold text-decoration-none ms-1">Kirish</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>