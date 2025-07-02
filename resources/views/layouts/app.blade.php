<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            --sidebar-width: 280px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            height: 100vh;
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            background: var(--dark-gradient);
            backdrop-filter: blur(10px);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: var(--transition);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .user-details h4 {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-role {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            text-transform: capitalize;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: var(--transition);
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link i {
            width: 20px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .logout-link {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
        }

        .logout-link .nav-link {
            background: var(--secondary-gradient);
            color: white;
        }

        .logout-link .nav-link:hover {
            transform: translateX(5px) scale(1.02);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.3);
        }

        .content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: var(--transition);
        }

        .content-header {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .welcome-card {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, -20px) rotate(180deg); }
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1100;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .mobile-toggle:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 1rem;
            }

            .mobile-toggle {
                display: block;
            }

            .content {
                padding-top: 4rem;
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        /* Custom scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <!-- Mobile Toggle -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name ?? 'G', 0, 1) }}
                </div>
                <div class="user-details">
                    <h4>{{ auth()->user()->name ?? 'Guest' }}</h4>
                    @auth
                        <div class="user-role">{{ auth()->user()->role ?? 'user' }}</div>
                    @else
                        <div class="user-role">Guest</div>
                    @endauth
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
            </div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard Admin
                        </a>
                    </div>
                     <div class="nav-item">
        <a href="{{ route('admin.vendors.index') }}" class="nav-link">
            <i class="fas fa-users"></i>
            Daftar Vendor
        </a>
    </div>
                    <!-- <div class="nav-item">
                        <a href="{{ route('bookings.index') }}" class="nav-link">
                            <i class="fas fa-search"></i>
                            Bookings
                        </a>
                    </div> -->
                    <!-- <div class="nav-item">
                        <a href="{{ route('admin.hotels.index') }}" class="nav-link">
                            <i class="fas fa-building"></i>
                            Kelola Hotel
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.rooms.index') }}" class="nav-link">
                            <i class="fas fa-bed"></i>
                            Kelola Kamar
                        </a>
                    </div> -->
                @elseif(auth()->user()->role === 'vendor')
                    <div class="nav-item">
                        <a href="{{ route('hotels.index') }}" class="nav-link">
                            <i class="fas fa-hotel"></i>
                            Hotel Saya
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('rooms.index') }}" class="nav-link">
                            <i class="fas fa-door-open"></i>
                            Kamar Saya
                        </a>
                    </div>
                        <div class="nav-item">
        <a href="{{ route('vendor.profile') }}" class="nav-link">
            <i class="fas fa-user"></i>
            Data Diri Saya
        </a>
    </div>

                @elseif(auth()->user()->role === 'user')
                    <div class="nav-item">
                        <a href="{{ route('hotels.user') }}" class="nav-link">
                            <i class="fas fa-search"></i>
                            Pilih Hotel
                        </a>
                    </div>
                @endif

                <div class="nav-item logout-link">
                    <a href="{{ route('logout') }}" class="nav-link" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <div class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('register.vendor') }}" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        Register Vendor
                    </a>
                </div>
            @endauth
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Welcome Section -->
        <div class="welcome-card">
            <h1><i class="fas fa-sparkles me-2"></i>Selamat Datang!</h1>
            <p class="mb-0">Kelola sistem hotel Anda dengan mudah dan efisien</p>
        </div>

        @yield('content')

        <!-- Demo Content -->
        <div class="feature-grid">
            <div class="feature-card">
                <h5><i class="fas fa-chart-line text-primary me-2"></i>Analytics</h5>
                <p class="text-muted mb-0">Pantau performa hotel Anda dengan dashboard analytics yang lengkap</p>
            </div>
            <div class="feature-card">
                <h5><i class="fas fa-users text-success me-2"></i>User Management</h5>
                <p class="text-muted mb-0">Kelola pengguna dan hak akses dengan sistem role yang fleksibel</p>
            </div>
            <div class="feature-card">
                <h5><i class="fas fa-calendar-check text-warning me-2"></i>Booking System</h5>
                <p class="text-muted mb-0">Sistem reservasi yang terintegrasi dan mudah digunakan</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.overlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggle.contains(event.target) && 
                sidebar.classList.contains('active')) {
                toggleSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.overlay');
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        });

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>