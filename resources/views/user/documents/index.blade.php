<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hujjatlar kutubxonasi | OlisHudud</title>
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
            width: 42px; height: 42px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* Search va filter */
        .search-box {
            max-width: 500px;
        }
        .search-box input {
            border-radius: 50px 0 0 50px;
            border-right: none;
            padding-left: 1.5rem;
        }
        .search-box .btn {
            border-radius: 0 50px 50px 0;
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Kategoriya tugmalari */
        .category-btn {
            background: white;
            border: 2px solid var(--border);
            border-radius: 50px;
            padding: 0.5rem 1.3rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .category-btn.active, .category-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Hujjat kartasi */
        .doc-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 1.3rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 18px rgba(0,0,0,0.05);
            height: 100%;
        }
        .doc-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(99,102,241,0.18);
            border-color: var(--primary);
        }
        .doc-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1rem;
        }
        .pdf { background: linear-gradient(135deg, #ef4444, #f87171); color: white; }
        .doc { background: linear-gradient(135deg, #3b82f6, #60a5fa); color: white; }
        .docx { background: linear-gradient(135deg, #3b82f6, #60a5fa); color: white; }
        .ppt { background: linear-gradient(135deg, #f97316, #fb923c); color: white; }
        .xls { background: linear-gradient(135deg, #16a34a, #4ade80); color: white; }
        .other { background: linear-gradient(135deg, #6b7280, #9ca3af); color: white; }

        .btn-download {
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 600;
        }
        .btn-download:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(99,102,241,0.4);
        }

        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Navbar (xuddi bosh sahifadagi kabi) -->
<nav class="navbar sticky-top">
    <div class="container-fluid px-4">
        <a href="/" class="navbar-brand fw-bold text-primary fs-4">OlisHudud</a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary d-none d-sm-inline-block">
                Bosh sahifa
            </a>

            <a href="{{ route('videos.index') }}" class="btn btn-success d-none d-sm-inline-block">
                Videolar
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
                    <li><form method="POST" action=""><button type="submit" class="dropdown-item text-danger">Chiqish</button></form></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Hujjatlar kutubxonasi</h1>
        <p class="lead text-muted">Barcha fanlar bo‘yicha tayyor materiallar – PDF, Word, PPT</p>
    </div>

    <!-- Qidiruv va kategoriyalar -->
    <div class="row justify-content-center mb-5 g-3">
        <div class="col-lg-6">
            <div class="search-box mx-auto">
                <div class="input-group">
                    <input type="text Chrissearch" class="form-control form-control-lg shadow-sm" placeholder="Hujjat nomi yoki mavzu bo‘yicha qidiring..." id="searchInput">
                    <button class="btn btn-primary btn-lg">
                        Qidiruv
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategoriyalar -->
    <div class="text-center mb-5">
        <div class="d-inline-flex flex-wrap gap-3 justify-content-center">
            <button class="category-btn active" data-category="all">Barchasi</button>
            @foreach ($subjects as $subject)
                <button class="category-btn" data-category="{{ $subject->name }}">{{ $subject->name }}</button>
            @endforeach


        </div>
    </div>

    <!-- Hujjatlar ro‘yxati -->
    <div class="row g-4" id="documentsGrid">
        @foreach ($documents as $document)
            

        <!-- 1 -->
        <div class="col-md-6 col-lg-4 col-xl-3" data-category="{{  $document->subject->name  }}">
            <div class="doc-card position-relative">
                <div class="category-badge">{{  $document->subject->name  }}</div>
                <div class="p-4 text-center">
                    <div class="doc-icon {{  strtolower($document->type)  }}">
                        {{  strtoupper($document->type)  }}
                    </div>
                    <h5 class="fw-bold mb-3">{{ $document->title }}</h5>
                    <p class="text-muted small mb-4">{{ $document->created_at }}</p>
<a href="{{ Storage::url($document->file_path) }}" 
   class="btn btn-download text-white" 
   download="{{ $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION) }}">
    <i class="fas fa-download me-2"></i>Yuklab olish
</a>
                </div>
            </div>
        </div>

        @endforeach


        <!-- Yana qo‘shishingiz mumkin... -->
        
    </div>

    <!-- Mobil uchun natijalar tugmasi -->
    <div class="text-center mt-5 d-sm-none">

        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg">
            Bosh Sahifa
        </a>

        <a href="{{ route('videos.index') }}" class="btn btn-success btn-lg">
            Videolar
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Kategoriya filter
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const category = btn.getAttribute('data-category');
            document.querySelectorAll('#documentsGrid > div').forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Qidiruv
    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#documentsGrid .doc-card').forEach(card => {
            const title = card.querySelector('h5').textContent.toLowerCase();
            const desc = card.querySelector('p').textContent.toLowerCase();
            if (title.includes(query) || desc.includes(query)) {
                card.parentElement.style.display = '';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>