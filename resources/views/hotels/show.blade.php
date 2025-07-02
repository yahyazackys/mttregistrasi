@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Hotel Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-gradient-primary text-white rounded-lg p-4 shadow-lg">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h2 class="mb-2 fw-bold">{{ $hotel->name }}</h2>
                        <p class="mb-0 opacity-90">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $hotel->address }}
                        </p>
                    </div>
                    <div class="text-end">
                        <div class="badge bg-light text-primary fs-6 px-3 py-2">
                            <i class="fas fa-bed me-1"></i>
                            {{ count($hotel->rooms) }} Tipe Kamar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Types Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-dark mb-4">
                <i class="fas fa-door-open me-2 text-primary"></i>
                Tipe Kamar Tersedia
            </h4>
        </div>
    </div>

    <div class="row g-4">
        @foreach($hotel->rooms as $room)
            <div class="col-lg-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100 room-card">
                    <!-- Room Image -->
                    <div class="position-relative overflow-hidden">
                        @if($room->photo)
                            <img src="{{ asset('storage/'.$room->photo) }}" 
                                 class="card-img-top room-image" 
                                 alt="Foto {{ $room->name }}"
                                 style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 220px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary px-3 py-2">
                                <i class="fas fa-star me-1"></i>
                                Premium
                            </span>
                        </div>
                    </div>

                    <!-- Room Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark mb-3">{{ $room->name }}</h5>
                        
                        <!-- Room Info Grid -->
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-expand-arrows-alt me-2 text-primary"></i>
                                    <span class="fw-medium">Luas: {{ $room->size }}</span>
                                </div>
                            </div>
                            
                            @if($room->facilities && count($room->facilities) > 0)
                                <div class="col-12">
                                    <div class="mb-2">
                                        <i class="fas fa-concierge-bell me-2 text-primary"></i>
                                        <span class="fw-medium text-muted">Fasilitas:</span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach(array_slice($room->facilities, 0, 3) as $facility)
                                            <span class="badge bg-light text-dark border">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($room->facilities) > 3)
                                            <span class="badge bg-secondary">+{{ count($room->facilities) - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Price Section -->
                        <div class="mt-auto">
                            <div class="bg-light rounded p-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-muted">Rate Corporate</small>
                                        <div class="fw-bold text-success fs-5">
                                            Rp {{ number_format($room->corporate_rate, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">per malam</small>
                                    </div>
                                    <i class="fas fa-tag text-success fa-2x opacity-50"></i>
                                </div>
                            </div>

                            <!-- Booking Button -->
                            @auth
                                @if(auth()->user()->role === 'user')
                                    <a href="{{ route('bookings.create', $room->id) }}" 
                                       class="btn btn-primary w-100 py-2 fw-medium">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        Booking Sekarang
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="btn btn-outline-primary w-100 py-2 fw-medium">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Login untuk Booking
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty State -->
    @if(count($hotel->rooms) === 0)
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-bed text-muted" style="font-size: 4rem;"></i>
            </div>
            <h5 class="text-muted mb-3">Tidak ada kamar tersedia</h5>
            <p class="text-muted">Saat ini tidak ada tipe kamar yang tersedia untuk hotel ini.</p>
        </div>
    @endif
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.room-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.room-image {
    transition: transform 0.3s ease;
}

.room-card:hover .room-image {
    transform: scale(1.05);
}

.badge {
    font-size: 0.85em;
}

.btn {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.card {
    border-radius: 15px;
}

.rounded-lg {
    border-radius: 15px;
}

@media (max-width: 768px) {
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .bg-gradient-primary .d-flex {
        flex-direction: column;
        text-align: center;
    }
    
    .bg-gradient-primary .text-end {
        text-align: center !important;
        margin-top: 1rem;
    }
}
</style>
@endsection