<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OlisHudud - Buxoro Pedagogik Mahorat Markazi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #ffffff 0%, #e8f4ff 40%, #d9ecff 100%);
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Gradient Title (BLUE) */
        .gradient-title {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(90deg, #00aaff, #0066ff, #0044cc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (max-width: 992px) {
            .gradient-title { font-size: 3rem; text-align: center; }
        }
        @media (max-width: 576px) {
            .gradient-title { font-size: 2.4rem; }
        }

        /* Register Button (BLUE) */
        .btn-register {
            background: linear-gradient(45deg, #00aaff, #0066ff);
            border: none;
            border-radius: 50px;
            padding: 14px 36px;
            font-weight: 600;
            color: white;
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.3);
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 102, 255, 0.4);
        }

        /* Login Button */
        .btn-login {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            padding: 14px 36px;
            color: #333;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: rgba(255, 255, 255, 1);
            border-color: rgba(0, 0, 0, 0.3);
        }

        /* Stat Boxes */
        .stat-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            padding: 18px 20px;
            min-width: 130px;
            text-align: center;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: 0.4s ease;
        }
        .stat-box:hover {
            transform: translateY(-6px) scale(1.03);
        }

        .stat-number {
            font-size: 2.4rem;
            font-weight: 900;
            background: linear-gradient(45deg, #00aaff, #0066ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.75;
            font-weight: 500;
        }

        .hero {
            padding: 100px 0;
            min-height: 100vh;
        }

        @media (max-width: 992px) {
            .hero {
                padding: 70px 0;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container hero text-center">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-12">

            <h1 class="gradient-title mb-4">
                Buxoro viloyat pedagogik mahorat markazi
            </h1>

            <p class="lead mb-2" style="font-size: 1.35rem; font-weight: 600;">
                "Birgalikda yuksalamiz"
            </p>

            <p class="mb-5" style="font-size: 1.1rem; line-height: 1.7;">
                Olis hudud maktabining mukammallik sari qadamiga - Pedagogik mahorat markazi ko‘prikdir
            </p>

            @auth()

            <div class="d-flex flex-wrap gap-3 mb-5 justify-content-center">
                <a href="/direction" class="btn btn-register">KIRISH</a>
            </div>

            @else

            <div class="d-flex flex-wrap gap-3 mb-5 justify-content-center">
                <a href="/register" class="btn btn-register">Ro'yxatdan o'tish</a>
                <a href="/login" class="btn btn-login">Kirish</a>
            </div>
                
            @endauth



            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <div class="stat-box">
                    <div class="stat-number">{{ $users }}</div>
                    <div class="stat-label">Foydalanuvchilar</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">{{ $quizzes }}</div>
                    <div class="stat-label">Testlar</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">{{ $subjects }}</div>
                    <div class="stat-label">Fanlar</div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
