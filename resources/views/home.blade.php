@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="welcome-badge mb-3">
                            <i class="fas fa-sparkles me-2"></i>
                            Selamat Datang Kembali
                        </div>
                        <h1 class="hero-title mb-3">
                            Halo, <span class="text-primary">{{ Auth::user()->name ?? 'Guest' }}</span>! 👋
                        </h1>
                        <p class="hero-subtitle mb-4">
                            Kelola booking hotel Anda dengan mudah dan nikmati pengalaman menginap yang tak terlupakan.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('hotels.index') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-search me-2"></i>
                                Cari Hotel
                            </a>
                            <a href="#quick-stats" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-chart-line me-2"></i>
                                Lihat Statistik
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="floating-card">
                            <i class="fas fa-hotel fa-4x text-primary mb-3"></i>
                            <h5>Hotel Management</h5>
                            <p class="text-muted">Sistem booking hotel terpercaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="container" id="quick-stats">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">150+</h3>
                        <p class="stat-label">Hotel Partner</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">2,500+</h3>
                        <p class="stat-label">Booking Sukses</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">1,200+</h3>
                        <p class="stat-label">User Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">4.8</h3>
                        <p class="stat-label">Rating Rata-rata</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h3 class="section-title mb-4">
                    <i class="fas fa-rocket me-2 text-primary"></i>
                    Fitur Unggulan
                </h3>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <h5 class="feature-title">Pencarian Cerdas</h5>
                    <p class="feature-description">
                        Temukan hotel terbaik dengan filter lokasi, harga, dan fasilitas yang sesuai kebutuhan Anda.
                    </p>
                    <a href="{{ route('hotels.index') }}" class="feature-link">
                        Coba Sekarang <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5 class="feature-title">Booking Mudah</h5>
                    <p class="feature-description">
                        Proses booking yang simpel dan cepat dalam beberapa klik. Konfirmasi instan untuk kenyamanan Anda.
                    </p>
                    <a href="#" class="feature-link">
                        Pelajari Lebih <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="feature-title">Aman & Terpercaya</h5>
                    <p class="feature-description">
                        Transaksi aman dengan enkripsi tinggi dan jaminan uang kembali jika terjadi pembatalan.
                    </p>
                    <a href="#" class="feature-link">
                        Info Keamanan <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4">
            <div class="col-12">
                <h3 class="section-title mb-4">
                    <i class="fas fa-bolt me-2 text-primary"></i>
                    Aksi Cepat
                </h3>
            </div>
            <div class="col-lg-6">
                <div class="action-card bg-gradient-primary text-white">
                    <div class="action-content">
                        <h5 class="mb-3">Mulai Booking Hotel</h5>
                        <p class="mb-4 opacity-90">
                            Jelajahi berbagai pilihan hotel dengan fasilitas terbaik dan harga kompetitif.
                        </p>
                        <a href="{{ route('hotels.index') }}" class="btn btn-light">
                            <i class="fas fa-search me-2"></i>
                            Cari Hotel Sekarang
                        </a>
                    </div>
                    <div class="action-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="action-card bg-gradient-success text-white">
                    <div class="action-content">
                        <h5 class="mb-3">Riwayat Booking</h5>
                        <p class="mb-4 opacity-90">
                            Lihat dan kelola semua booking Anda dalam satu tempat yang mudah diakses.
                        </p>
                        <a href="#" class="btn btn-light">
                            <i class="fas fa-history me-2"></i>
                            Lihat Riwayat
                        </a>
                    </div>
                    <div class="action-icon">
                        <i class="fas fa-list-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-wrapper {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding-top: 2rem;
}

.hero-section {
    padding: 4rem 0;
}

.min-vh-50 {
    min-height: 50vh;
}

.welcome-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1.2;
    color: #2c3e50;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    line-height: 1.6;
}

.hero-illustration {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.floating-card {
    background: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.stat-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.stat-label {
    color: #6c757d;
    margin: 0;
    font-weight: 500;
}

.section-title {
    font-weight: 600;
    color: #2c3e50;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}

.feature-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.feature-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.feature-link {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.feature-link:hover {
    color: #0a58ca;
    transform: translateX(5px);
}

.action-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.action-icon {
    font-size: 4rem;
    opacity: 0.3;
    transform: rotate(-15deg);
}

.action-content {
    flex: 1;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .hero-actions .btn {
        width: 100%;
        margin-right: 0 !important;
    }
    
    .floating-card {
        padding: 2rem 1.5rem;
    }
    
    .action-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .action-icon {
        order: -1;
        font-size: 3rem;
    }
}
</style>
@endsection