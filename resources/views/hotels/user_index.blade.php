@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="fas fa-hotel me-3"></i>
                Temukan Hotel Impian Anda
            </h1>
            <p class="hero-subtitle">Pilih dari koleksi hotel terbaik dengan fasilitas premium</p>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $hotels->count() }}</div>
                <div class="stat-label">Hotel Tersedia</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $total }}</div>
                <div class="stat-label">Total Kamar</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-card">
            <h5><i class="fas fa-filter me-2"></i>Filter Hotel</h5>
            <div class="filter-options">
                <div class="filter-group">
                    <label>Kategori</label>
                    <select class="form-select filter-select" id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="Non-bintang">Non-bintang</option>
                        <option value="Bintang 1">Bintang 1</option>
                        <option value="Bintang 2">Bintang 2</option>
                        <option value="Bintang 3">Bintang 3</option>
                        <option value="Bintang 4">Bintang 4</option>
                        <option value="Bintang 5">Bintang 5</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Kota</label>
                    <select class="form-select filter-select" id="cityFilter">
                        <option value="">Semua Kota</option>
                        @foreach($hotels->pluck('city')->unique() as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Jumlah Kamar</label>
                    <select class="form-select filter-select" id="roomsFilter">
                        <option value="">Semua</option>
                        <option value="1-50">1-50 Kamar</option>
                        <option value="51-100">51-100 Kamar</option>
                        <option value="101+">101+ Kamar</option>
                    </select>
                </div>
                <button class="btn btn-primary filter-btn" onclick="applyFilters()">
                    <i class="fas fa-search me-2"></i>Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Hotels Grid -->
    <div class="hotels-grid" id="hotelsGrid">
        @forelse($hotels as $hotel)
            <div class="hotel-card" data-category="{{ $hotel->category }}" data-city="{{ $hotel->city }}" data-rooms="{{ $hotel->total_rooms }}">
                <div class="hotel-image-container">
                    @if($hotel->photo)
                        <img src="{{ asset('storage/' . $hotel->photo) }}" class="hotel-image" alt="{{ $hotel->name }}">
                    @else
                        <div class="hotel-placeholder">
                            <i class="fas fa-building"></i>
                            <span>No Image</span>
                        </div>
                    @endif
                    
                    <!-- Category Badge -->
                    <div class="category-badge">
                        @if($hotel->category === 'Non-bintang')
                            <i class="fas fa-home me-1"></i>{{ $hotel->category }}
                        @else
                            @for($i = 1; $i <= (int)substr($hotel->category, -1); $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <button class="action-btn favorite-btn" title="Tambah ke Favorit">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="action-btn share-btn" title="Bagikan">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>

                <div class="hotel-content">
                    <div class="hotel-header">
                        <h5 class="hotel-name">{{ $hotel->name }}</h5>
                        <div class="hotel-rating">
                            @if($hotel->category !== 'Non-bintang')
                                @for($i = 1; $i <= (int)substr($hotel->category, -1); $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            @endif
                        </div>
                    </div>

                    <div class="hotel-location">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>{{ $hotel->city }}</span>
                    </div>

                    <div class="hotel-address">
                        <i class="fas fa-location-dot me-2"></i>
                        <span>{{ Str::limit($hotel->address, 60) }}</span>
                    </div>

                    <div class="hotel-stats">
                        <div class="stat">
                            <i class="fas fa-bed"></i>
                            <span>{{ $hotel->rooms->count() }} Tipe Kamar
</span>
                        </div>
                        @if($hotel->map_embed)
                            <div class="stat">
                                <i class="fas fa-map"></i>
                                <span>Lokasi Tersedia</span>
                            </div>
                        @endif
                    </div>

                    @if($hotel->facilities && count($hotel->facilities) > 0)
    <div class="hotel-facilities">
        <h6>Fasilitas Utama:</h6>
        <div class="facilities-list">
            @foreach($hotel->facilities as $facility)  
                <span class="facility-tag">
                    <i class="fas fa-check me-1"></i>{{ $facility }}
                </span>
            @endforeach
        </div>
    </div>
@endif

                    <!-- Room Preview -->
                    @if($hotel->rooms->count() > 0)
                        <div class="room-preview">
                            <div class="room-info">
                                <span class="room-count">{{ $hotel->rooms->count() }} Tipe Kamar</span>
                                <span class="price-from">
                                    Mulai dari <strong>Rp {{ number_format($hotel->rooms->min('publish_rate'), 0, ',', '.') }}</strong>/malam
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="hotel-actions">
                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary view-rooms-btn">
                            <i class="fas fa-eye me-2"></i>Lihat Kamar
                        </a>
                        @if($hotel->map_embed)
                            <button class="btn btn-outline-secondary map-btn" onclick="showMap('{{ $hotel->name }}', '{{ $hotel->map_embed }}')">
                                <i class="fas fa-map-marked-alt"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h4>Tidak Ada Hotel Ditemukan</h4>
                <p>Maaf, tidak ada hotel yang tersedia saat ini. Silakan coba lagi nanti atau hubungi customer service kami.</p>
                <button class="btn btn-primary" onclick="location.reload()">
                    <i class="fas fa-refresh me-2"></i>Muat Ulang
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->

</div>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalTitle">Lokasi Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="mapContainer" style="height: 400px; border-radius: 8px; overflow: hidden;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: float 8s ease-in-out infinite;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
    }

    .stat-item {
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        padding: 1rem;
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .filter-section {
        margin-bottom: 2rem;
    }

    .filter-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .filter-options {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
        color: #495057;
    }

    .filter-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
    }

    .filter-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .filter-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .hotels-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .hotel-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
    }

    .hotel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .hotel-image-container {
        position: relative;
        height: 250px;
        overflow: hidden;
    }

    .hotel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .hotel-card:hover .hotel-image {
        transform: scale(1.05);
    }

    .hotel-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3rem;
    }

    .hotel-placeholder span {
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .category-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .category-badge .fa-star {
        color: #ffc107;
        margin-right: 0.1rem;
    }

    .quick-actions {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        backdrop-filter: blur(10px);
    }

    .action-btn:hover {
        background: white;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .favorite-btn:hover {
        color: #dc3545;
    }

    .share-btn:hover {
        color: #0d6efd;
    }

    .hotel-content {
        padding: 1.5rem;
    }

    .hotel-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .hotel-name {
        font-size: 1.25rem;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 0;
        flex: 1;
    }

    .hotel-rating {
        margin-left: 1rem;
    }

    .hotel-location,
    .hotel-address {
        color: #718096;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    .hotel-location i,
    .hotel-address i {
        color: #667eea;
        width: 16px;
    }

    .hotel-stats {
        display: flex;
        gap: 1rem;
        margin: 1rem 0;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .stat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #495057;
        font-size: 0.9rem;
    }

    .stat i {
        color: #667eea;
    }

    .hotel-facilities {
        margin: 1rem 0;
    }

    .hotel-facilities h6 {
        color: #2d3748;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .facilities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .facility-tag {
        background: #e3f2fd;
        color: #1976d2;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .room-preview {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 1rem;
        border-radius: 12px;
        margin: 1rem 0;
    }

    .room-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .room-count {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .price-from {
        font-size: 0.95rem;
    }

    .hotel-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .view-rooms-btn {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.75rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .view-rooms-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    .map-btn {
        width: 50px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #667eea;
        color: #667eea;
        transition: all 0.3s;
    }

    .map-btn:hover {
        background: #667eea;
        color: white;
        transform: scale(1.05);
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        color: #e9ecef;
        margin-bottom: 1rem;
    }

    .empty-state h4 {
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #718096;
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    @media (max-width: 768px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }

        .hero-content h1 {
            font-size: 2rem;
        }

        .hero-stats {
            justify-content: center;
        }

        .filter-options {
            flex-direction: column;
        }

        .filter-group {
            min-width: auto;
        }

        .hotels-grid {
            grid-template-columns: 1fr;
        }

        .hotel-actions {
            flex-direction: column;
        }

        .map-btn {
            width: 100%;
        }
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(-20px, -20px) rotate(180deg); }
    }
</style>

<script>
    function applyFilters() {
        const categoryFilter = document.getElementById('categoryFilter').value;
        const cityFilter = document.getElementById('cityFilter').value;
        const roomsFilter = document.getElementById('roomsFilter').value;
        const hotelCards = document.querySelectorAll('.hotel-card');

        hotelCards.forEach(card => {
            let show = true;
            
            // Category filter
            if (categoryFilter && card.dataset.category !== categoryFilter) {
                show = false;
            }
            
            // City filter
            if (cityFilter && card.dataset.city !== cityFilter) {
                show = false;
            }
            
            // Rooms filter
            if (roomsFilter) {
                const roomCount = parseInt(card.dataset.rooms);
                switch (roomsFilter) {
                    case '1-50':
                        if (roomCount > 50) show = false;
                        break;
                    case '51-100':
                        if (roomCount < 51 || roomCount > 100) show = false;
                        break;
                    case '101+':
                        if (roomCount < 101) show = false;
                        break;
                }
            }
            
            card.style.display = show ? 'block' : 'none';
        });
        
        // Show message if no results
        const visibleCards = document.querySelectorAll('.hotel-card[style*="block"], .hotel-card:not([style*="none"])');
        if (visibleCards.length === 0) {
            showNoResultsMessage();
        } else {
            hideNoResultsMessage();
        }
    }

    function showNoResultsMessage() {
        hideNoResultsMessage();
        const grid = document.getElementById('hotelsGrid');
        const message = document.createElement('div');
        message.className = 'empty-state';
        message.id = 'noResults';
        message.innerHTML = `
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h4>Tidak Ada Hotel Ditemukan</h4>
            <p>Tidak ada hotel yang sesuai dengan filter yang Anda pilih. Silakan ubah kriteria pencarian.</p>
            <button class="btn btn-primary" onclick="clearFilters()">
                <i class="fas fa-times me-2"></i>Hapus Filter
            </button>
        `;
        grid.appendChild(message);
    }

    function hideNoResultsMessage() {
        const message = document.getElementById('noResults');
        if (message) {
            message.remove();
        }
    }

    function clearFilters() {
        document.getElementById('categoryFilter').value = '';
        document.getElementById('cityFilter').value = '';
        document.getElementById('roomsFilter').value = '';
        applyFilters();
    }

    function showMap(hotelName, mapEmbed) {
        document.getElementById('mapModalTitle').textContent = `Lokasi ${hotelName}`;
        document.getElementById('mapContainer').innerHTML = mapEmbed;
        new bootstrap.Modal(document.getElementById('mapModal')).show();
    }

    // Favorite functionality
    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.style.color = '#dc3545';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.style.color = '';
            }
        });
    });

    // Share functionality
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const hotelCard = this.closest('.hotel-card');
            const hotelName = hotelCard.querySelector('.hotel-name').textContent;
            
            if (navigator.share) {
                navigator.share({
                    title: hotelName,
                    text: `Lihat hotel ${hotelName} di aplikasi kami!`,
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link berhasil disalin ke clipboard!');
                });
            }
        });
    });

    // Smooth animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Apply animation to hotel cards
    document.querySelectorAll('.hotel-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
</script>
@endsection