<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Panel') | OlisHudud</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #4f46e5;
            --body-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--body-bg);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Layout Structure */
        #admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar {
            width: 270px;
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
            color: #94a3b8;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #ffffff;
            font-weight: 800;
            font-size: 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0.85rem;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-heading {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            padding: 1rem 0.75rem 0.4rem;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.925rem;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .nav-link-custom i {
            font-size: 1.15rem;
            width: 24px;
            text-align: center;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .nav-link-custom:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.07);
        }

        .nav-link-custom:hover i {
            color: #818cf8;
        }

        .nav-link-custom.active {
            color: #ffffff;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.35);
        }

        .nav-link-custom.active i {
            color: #ffffff;
        }

        /* Submenu collapse */
        .submenu-collapse {
            padding-left: 1rem;
            margin-bottom: 0.5rem;
        }

        .submenu-link {
            display: block;
            padding: 0.45rem 1rem 0.45rem 1.75rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s;
            position: relative;
        }

        .submenu-link::before {
            content: '';
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: #64748b;
            transition: all 0.2s;
        }

        .submenu-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .submenu-link:hover::before {
            background-color: #818cf8;
            width: 6px;
            height: 6px;
        }

        /* Content Wrapper */
        #content-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: var(--body-bg);
        }

        /* Top Navbar */
        .topbar-custom {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0.85rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
        }

        /* General Card & UI Improvements */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.03);
            background-color: #ffffff;
        }

        .table {
            --bs-table-bg: transparent;
        }

        .table th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .btn {
            font-weight: 600;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
        }

        /* Mobile Sidebar */
        @media (max-width: 992px) {
            #sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -270px;
            }
            #sidebar.show {
                left: 0;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                z-index: 999;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

<div id="admin-wrapper">

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="sidebar">
        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <div>
                <div>OlisHudud</div>
                <div class="small fw-normal text-muted" style="font-size: 0.7rem;">Admin Platform</div>
            </div>
        </a>

        <!-- Navigation Menu -->
        <ul class="sidebar-menu">
            <li class="sidebar-heading">Boshqaruv</li>
            
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Bosh sahifa</span>
                </a>
            </li>

            <li>
                <a href="{{ route('subjects.index') }}" class="nav-link-custom {{ request()->routeIs('subjects.*') && !request()->routeIs('quizzes.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open"></i>
                    <span>Fanlar</span>
                </a>
            </li>

            <li class="sidebar-heading">Materiallar & Savollar</li>

            <!-- Savollar Collapse -->
            <li>
                <a class="nav-link-custom d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#quizMenu" role="button">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-question-circle"></i>
                        <span>Savollar kiritish</span>
                    </div>
                    <i class="fas fa-chevron-down small opacity-50" style="font-size: 0.75rem;"></i>
                </a>
                <div class="collapse submenu-collapse {{ request()->is('admin/subjects/*/quizzes*') ? 'show' : '' }}" id="quizMenu">
                    @if(isset($subjects) && $subjects->count() > 0)
                        @foreach($subjects as $subj)
                            <a class="submenu-link" href="{{ route('quizzes.index', ['subject' => $subj->id]) }}">
                                {{ $subj->name }}
                            </a>
                        @endforeach
                    @else
                        <span class="submenu-link text-muted">Fanlar yo'q</span>
                    @endif
                </div>
            </li>

            <!-- Hujjatlar Collapse -->
            <li>
                <a class="nav-link-custom d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#docMenu" role="button">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-file-pdf"></i>
                        <span>Hujjatlar</span>
                    </div>
                    <i class="fas fa-chevron-down small opacity-50" style="font-size: 0.75rem;"></i>
                </a>
                <div class="collapse submenu-collapse" id="docMenu">
                    @if(isset($subjects) && $subjects->count() > 0)
                        @foreach($subjects as $subj)
                            <a class="submenu-link" href="{{ route('document.index', ['subject' => $subj->id]) }}">
                                {{ $subj->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </li>

            <!-- Videolar Collapse -->
            <li>
                <a class="nav-link-custom d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#videoMenu" role="button">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-play-circle"></i>
                        <span>Video darslar</span>
                    </div>
                    <i class="fas fa-chevron-down small opacity-50" style="font-size: 0.75rem;"></i>
                </a>
                <div class="collapse submenu-collapse" id="videoMenu">
                    @if(isset($subjects) && $subjects->count() > 0)
                        @foreach($subjects as $subj)
                            <a class="submenu-link" href="{{ route('video.index', ['subject' => $subj->id]) }}">
                                {{ $subj->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </li>

            <li class="sidebar-heading">Hisobot & Tizim</li>

            <li>
                <a href="{{ route('admin.results.index') }}" class="nav-link-custom {{ request()->routeIs('admin.results.index') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Test natijalari</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admins') }}" class="nav-link-custom {{ request()->routeIs('admins') ? 'active' : '' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Adminlar</span>
                </a>
            </li>
        </ul>

        <!-- User bottom strip -->
        <div class="p-3 border-top border-white border-opacity-10">
            <div class="d-flex align-items-center gap-2">
                <div class="admin-avatar" style="width: 36px; height: 36px; font-size: 0.85rem;">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <div class="fw-bold text-white small text-truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-muted" style="font-size: 0.7rem;">Administrator</div>
                </div>
                <button type="button" class="btn btn-sm text-danger p-0 ms-1" data-bs-toggle="modal" data-bs-target="#logoutModal" title="Chiqish">
                    <i class="fas fa-power-off fs-6"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- Content Area -->
    <div id="content-area">

        <!-- Topbar -->
        <header class="topbar-custom">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none rounded-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="d-none d-sm-block">
                    <span class="text-muted small">Bugun:</span>
                    <span class="fw-bold ms-1">{{ now()->format('d.m.Y') }}</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="/" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 d-none d-sm-inline-flex align-items-center gap-1">
                    <i class="fas fa-external-link-alt small"></i> Saytni ko'rish
                </a>

                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn p-0 border-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <div class="admin-avatar">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="text-start d-none d-md-block">
                            <div class="fw-bold small">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">ID: #{{ auth()->user()->id }}</small>
                        </div>
                        <i class="fas fa-chevron-down small text-muted ms-1" style="font-size: 0.75rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2 p-2">
                        <li>
                            <span class="dropdown-item-text small text-muted">
                                <strong>{{ auth()->user()->name }}</strong><br>
                                {{ auth()->user()->email }}
                            </span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item rounded-3 text-danger d-flex align-items-center gap-2" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i> Chiqish
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main View Content -->
        <main class="flex-grow-1 p-3 p-md-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white py-3 px-4 border-top text-center text-muted small">
            <div>&copy; {{ date('Y') }} <strong>OlisHudud</strong> • Buxoro viloyat pedagogik mahorat markazi</div>
        </footer>

    </div>

</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 border-0 shadow-lg p-3 text-center">
            <div class="my-3">
                <div class="d-inline-flex p-3 rounded-circle bg-danger bg-opacity-10 text-danger mb-3">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
                </div>
                <h5 class="fw-bold mb-1">Chiqishni tasdiqlang</h5>
                <p class="text-muted small mb-4">Haqiqatan ham hisobingizdan chiqmoqchimisiz?</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Yo'q</button>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4">Chiqish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Bundle JS (No external libraries needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}
</script>

@stack('scripts')
</body>
</html>