<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OlisHudud — Buxoro viloyat pedagogik mahorat markazi</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #7c3aed;
            --dark: #0f172a;
            --muted: #64748b;
            --light: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at 80% 20%, #e0e7ff 0%, #f8fafc 50%, #f1f5f9 100%);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        .landing-nav {
            padding: 1.25rem 0;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--dark);
            font-weight: 800;
            font-size: 1.35rem;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        /* Hero Section */
        .hero {
            padding: 5rem 0 4rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            background: rgba(79, 70, 229, 0.08);
            border: 1px solid rgba(79, 70, 229, 0.2);
            color: var(--primary);
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 1.75rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--muted);
            max-width: 720px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }

        /* Buttons */
        .btn-primary-gradient {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.9rem 2.5rem;
            font-weight: 700;
            font-size: 1.05rem;
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.35);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .btn-primary-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(79, 70, 229, 0.45);
            color: white;
        }

        .btn-light-outline {
            background: #ffffff;
            color: var(--dark);
            border: 2px solid #e2e8f0;
            border-radius: 50px;
            padding: 0.85rem 2.2rem;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .btn-light-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #f8faff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        /* Stats Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px -10px rgba(79, 70, 229, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.25rem;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .stat-number {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--muted);
            font-weight: 600;
        }

        /* Features Section */
        .feature-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #cbd5e1;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }

        .feature-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.3rem; }
            .hero-subtitle { font-size: 1rem; }
            .hero { padding: 3rem 0; }
        }
    </style>
</head>

<body>

<!-- Header / Nav -->
<header class="landing-nav sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="brand-box">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div>
                <div>OlisHudud</div>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2">
            @auth
                <a href="/direction" class="btn btn-primary-gradient px-4 py-2">
                    <i class="fas fa-th-large"></i> Boshqaruv paneli
                </a>
            @else
                <a href="/login" class="btn btn-light-outline px-4 py-2">Kirish</a>
                <a href="/register" class="btn btn-primary-gradient px-4 py-2 d-none d-sm-inline-flex">Ro'yxatdan o'tish</a>
            @endauth
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="hero-badge">
                    <i class="fas fa-award"></i> Buxoro viloyat pedagogik mahorat markazi
                </div>

                <h1 class="hero-title">
                    Tabiiy-ilmiy savodxonlik ko'nikmalarini <br>
                    <span class="gradient-text">raqamli texnologiyalar</span> yordamida rivojlantirish
                </h1>

                <p class="hero-subtitle">
                    Olis hudud maktabining mukammallik sari qadamiga — Pedagogik mahorat markazi ishonchli ko‘prikdir. "Birgalikda yuksalamiz!"
                </p>

                <div class="d-flex flex-wrap gap-3 justify-content-center mb-5">
                    @auth
                        <a href="/direction" class="btn btn-primary-gradient">
                            <span>Tizimga o'tish</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a href="/register" class="btn btn-primary-gradient">
                            <span>Boshlash (Ro'yxatdan o'tish)</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="/login" class="btn btn-light-outline">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Kirish</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Stat Boxes -->
        <div class="row g-4 mt-2 justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">{{ number_format($users) }}</div>
                    <div class="stat-label">Faol o‘quvchilar</div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(124, 58, 237, 0.1); color: #7c3aed;">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="stat-number">{{ number_format($quizzes) }}</div>
                    <div class="stat-label">Test savollari</div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-number">{{ number_format($subjects) }}</div>
                    <div class="stat-label">O‘quv fanlari</div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="row g-4 mt-5 text-start">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Interaktiv Testlar</h5>
                    <p class="text-muted small mb-0">Yagona va ko‘p tanlovli (multiple-choice) zamonaviy testlar orqali bilimlaringizni real vaqt rejimida sinang.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box bg-success bg-opacity-10 text-success">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Ilmiy Hujjatlar</h5>
                    <p class="text-muted small mb-0">Fanlar bo‘yicha tajribali pedagoglar tomonidan tayyorlangan elektron qo‘llanma va hujjatlarni bepul yuklab oling.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon-box bg-danger bg-opacity-10 text-danger">
                        <i class="fas fa-video"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Video Darslar</h5>
                    <p class="text-muted small mb-0">Murakkab mavzularni oson va qiziqarli tushuntiruvchi saralangan video darslar to‘plami.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Footer -->
<footer class="py-4 border-top bg-white text-center text-muted small mt-5">
    <div class="container">
        <div>&copy; {{ date('Y') }} <strong>OlisHudud</strong> • Buxoro viloyat pedagogik mahorat markazi. Barcha huquqlar himoyalangan.</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
