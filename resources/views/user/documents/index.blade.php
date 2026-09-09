<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hujjatlar kutubxonasi | OlisHudud</title>

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

        .category-pill {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 50px;
            padding: 0.45rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #64748b;
            transition: all 0.2s;
            cursor: pointer;
        }

        .category-pill.active, .category-pill:hover {
            background: #4f46e5;
            color: #ffffff;
            border-color: #4f46e5;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .doc-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .doc-card:hover {
            transform: translateY(-6px);
            border-color: #cbd5e1;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }

        .file-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .pdf-box { background: #fef2f2; color: #dc2626; }
        .doc-box { background: #eff6ff; color: #2563eb; }
        .ppt-box { background: #fff7ed; color: #ea580c; }
        .xls-box { background: #f0fdf4; color: #16a34a; }
        .other-box { background: #f1f5f9; color: #64748b; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="user-nav sticky-top">
    <div class="container-fluid px-lg-5 px-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5">
            <div class="p-2 rounded-3 text-white" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
                <i class="fas fa-arrow-left"></i>
            </div>
            <span>Bosh sahifaga qaytish</span>
        </a>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('videos.index') }}" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                <i class="fas fa-play-circle me-1"></i> Videolar
            </a>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill d-none d-sm-inline-block">
                {{ auth()->user()->name }}
            </span>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2">Hujjatlar kutubxonasi</h2>
        <p class="text-muted">Barcha fanlar bo‘yicha ilmiy-uslubiy qo‘llanmalar, prezentatsiya va tarqatmalar</p>

        <!-- Qidiruv -->
        <div class="col-md-6 mx-auto mt-4">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" id="searchInput" class="form-control border-start-0 rounded-end-pill py-2" placeholder="Hujjat nomi bo‘yicha qidiring...">
            </div>
        </div>
    </div>

    <!-- Kategoriyalar -->
    <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
        <button class="category-pill active" data-category="all">Barchasi</button>
        @foreach ($subjects as $subject)
            <button class="category-pill" data-category="{{ $subject->name }}">{{ $subject->name }}</button>
        @endforeach
    </div>

    <!-- Hujjatlar grid -->
    <div class="row g-4" id="documentsGrid">
        @forelse ($documents as $document)
            @php
                $ext = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                $boxClass = match($ext) {
                    'pdf' => 'pdf-box',
                    'doc', 'docx' => 'doc-box',
                    'ppt', 'pptx' => 'ppt-box',
                    'xls', 'xlsx' => 'xls-box',
                    default => 'other-box'
                };
                $iconClass = match($ext) {
                    'pdf' => 'fa-file-pdf',
                    'doc', 'docx' => 'fa-file-word',
                    'ppt', 'pptx' => 'fa-file-powerpoint',
                    'xls', 'xlsx' => 'fa-file-excel',
                    default => 'fa-file-alt'
                };
            @endphp
            <div class="col-md-6 col-lg-4 col-xl-3 doc-item" data-category="{{ $document->subject->name }}">
                <div class="doc-card p-4">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="file-icon-box {{ $boxClass }}">
                                <i class="fas {{ $iconClass }}"></i>
                            </div>
                            <span class="badge bg-light text-dark border small rounded-pill">
                                {{ $document->subject->name }}
                            </span>
                        </div>
                        <h6 class="fw-bold text-dark mb-2 text-truncate" title="{{ $document->title }}">{{ $document->title }}</h6>
                        <small class="text-muted d-block mb-3">{{ $document->created_at->format('d.m.Y') }}</small>
                    </div>

                    <a href="{{ Storage::url($document->file_path) }}" 
                       class="btn btn-sm btn-outline-primary rounded-pill w-100 py-2 d-flex align-items-center justify-content-center gap-2" 
                       download="{{ $document->title . '.' . $ext }}">
                        <i class="fas fa-download"></i> Yuklab olish
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-muted">
                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                <h5>Hozircha hujjatlar mavjud emas</h5>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.category-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.category-pill').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const category = btn.getAttribute('data-category');
            document.querySelectorAll('.doc-item').forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.doc-item').forEach(card => {
            const title = card.querySelector('h6').textContent.toLowerCase();
            if (title.includes(query)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>