@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-primary mb-1">
                        <i class="fas fa-hotel me-2"></i>Admin Dashboard
                    </h2>
                    <p class="text-muted mb-0">Kelola semua hotel dalam sistem</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('hotels.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Hotel
                    </a>
                    <button class="btn btn-outline-secondary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Total Hotel</h6>
                            <h3 class="mb-0">{{ $hotels->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-building fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Total Kamar</h6>
                            <h3 class="mb-0">{{ $hotels->sum('total_rooms') }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-bed fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Vendor Aktif</h6>
                            <h3 class="mb-0">{{ $hotels->groupBy('user_id')->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title text-white-50">Kota</h6>
                            <h3 class="mb-0">{{ $hotels->groupBy('city')->count() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-map-marker-alt fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hotels Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2 text-primary"></i>Daftar Hotel
                    </h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari hotel..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="hotelsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold">
                                <i class="fas fa-hotel me-2 text-primary"></i>Hotel
                            </th>
                            <th class="border-0 fw-semibold">
                                <i class="fas fa-user-tie me-2 text-primary"></i>Vendor
                            </th>
                            <th class="border-0 fw-semibold">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>Lokasi
                            </th>
                            <th class="border-0 fw-semibold">
                                <i class="fas fa-star me-2 text-primary"></i>Kategori
                            </th>
                            <th class="border-0 fw-semibold">
                                <i class="fas fa-bed me-2 text-primary"></i>Kamar
                            </th>
                            <th class="border-0 fw-semibold text-center">
                                <i class="fas fa-cog me-2 text-primary"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hotels as $hotel)
                        <tr>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-building text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $hotel->name }}</h6>
                                        <small class="text-muted">Hotel ID: #{{ $hotel->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div>
                                    <div class="fw-semibold">{{ $hotel->user->pic_name ?? $hotel->user->name }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>{{ $hotel->user->email }}
                                    </small>
                                </div>
                            </td>
                            <td class="align-middle">
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $hotel->city }}
                                </span>
                            </td>
                            <td class="align-middle">
                                @php
                                    $categoryColor = match($hotel->category) {
                                        'Bintang 5' => 'warning',
                                        'Bintang 4' => 'info',
                                        'Bintang 3' => 'success',
                                        'Bintang 2' => 'secondary',
                                        'Bintang 1' => 'dark',
                                        default => 'primary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $categoryColor }}">
                                    {{ $hotel->category }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <span class="fw-bold text-primary">{{ $hotel->total_rooms }}</span>
                                <small class="text-muted">kamar</small>
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('hotels.show', $hotel->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('hotels.edit', $hotel->id) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit Hotel">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Hapus Hotel"
                                            onclick="deleteHotel({{ $hotel->id }}, '{{ $hotel->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-hotel fa-3x mb-3 opacity-50"></i>
                                    <h5>Belum ada hotel</h5>
                                    <p>Klik tombol "Tambah Hotel" untuk menambah hotel pertama</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
       
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus hotel <strong id="hotelName"></strong>?</p>
                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus Hotel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-group .btn {
    border-radius: 0.375rem !important;
    margin-right: 0.25rem;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-group .btn {
        margin-bottom: 0.25rem;
        margin-right: 0;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
}

.opacity-75 {
    opacity: 0.75;
}

.opacity-50 {
    opacity: 0.5;
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#hotelsTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Delete confirmation
function deleteHotel(hotelId, hotelName) {
    document.getElementById('hotelName').textContent = hotelName;
    document.getElementById('deleteForm').action = `/hotels/${hotelId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Print functionality
window.addEventListener('beforeprint', function() {
    document.querySelectorAll('.btn, .input-group').forEach(el => {
        el.style.display = 'none';
    });
});

window.addEventListener('afterprint', function() {
    document.querySelectorAll('.btn, .input-group').forEach(el => {
        el.style.display = '';
    });
});
</script>
@endsection