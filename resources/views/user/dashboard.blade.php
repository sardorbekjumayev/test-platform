<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bosh sahifa | OlisHudud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #eef2ff;
            --gray: #64748b;
            --light: #f8fafc;
            --border: #e2e8f0;
        }
        body {
            background: var(--light);
            color: #1e293b;
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 1rem 0;
        }
        .user-avatar {
            width: 42px;
            height: 42px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .subject-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 1.2rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            height: 100%;
        }
        .subject-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
            border-color: var(--primary);
        }
        .subject-icon {
            height: 100px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.8rem;
        }
        .btn-start {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.65rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-start:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
        }
        .btn-results {
            background: #10b981;
            color: white;
            border-radius: 50px;
            padding: 0.65rem 1.8rem;
            font-weight: 600;
        }
        .btn-results:hover {
            background: #059669;
        }
        @media (max-width: 576px) {
            .navbar .btn { font-size: 0.9rem; padding: 0.5rem 1rem; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar sticky-top">
    <div class="container-fluid px-4">
        <a href="/" class="navbar-brand fw-bold text-primary fs-4">
            OlisHudud
        </a>

        <div class="d-flex align-items-center gap-3">
            <!-- Test natijalari tugmasi -->
            <a href="{{ route('results.index') }}" class="btn btn-results d-none d-sm-inline-block">
                Test natijalari
            </a>

                        <!-- Hujjatlar tugmasi -->
            <a href="{{ route('documents.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                Hujjatlar
            </a>

            <!-- videolar tugmasi -->
            <a href="{{ route('videos.index') }}" class="btn btn-success d-none d-sm-inline-block">
                Videolar
            </a>

            <!-- User profil -->
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
                    <li><a class="dropdown-item" href="">ID raqam: {{ auth()->user()->id }}</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{  route('logout')  }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Chiqish</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Fanlarni tanlang va test boshlang</h1>
        <p class="lead text-muted">7+ fan bo‘yicha tayyorgarlik testlari siz uchun tayyor</p>
    </div>

    <!-- Fanlar kartochkalari -->
    <div class="row g-4">

        @if ( $subjects_count > 0)

        @foreach($subjects as $subject)
<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="subject-card h-100">

    
        <div class="subject-icon p-0" style="height: 120px;">
            <img src="{{ $subject->image ? asset('storage/' . $subject->image) : asset('images/default-subject.jpg') }}"
                alt="Subject Image"
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
            </div>

        <div class="p-4 text-center">
            <h5 class="fw-bold mb-3">{{ $subject->name }}</h5>

            <a href="{{ route('documents.index')  }}" class="btn btn-secondary mb-2 d-block">
                Ma'lumot
            </a>

            <a href="{{ route('user.test.start', $subject->id) }}" class="btn btn-start d-block">
                Test boshlash
            </a>
        </div>
    </div>
</div>
@endforeach
            
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Hozircha fanlar mavjud emas. Iltimos, administrator bilan bog'laning.
                </div>
            </div>
        @endif



    </div>

    <!-- Mobil uchun alohida tugma -->
    <div class="text-center mt-5 d-sm-none">
        <a href="{{ route('results.index') }}" class="btn btn-results btn-lg">
            Test natijalari
        </a>

        <a href="{{ route('documents.index') }}" class="btn btn-primary btn-lg">
            Hujjatlar
        </a>

        <a href="{{ route('videos.index') }}" class="btn btn-success btn-lg">
            Videolar
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>