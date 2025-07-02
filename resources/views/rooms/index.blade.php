@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-primary mb-1">
                <i class="fas fa-bed me-2"></i>Daftar Tipe Kamar
            </h2>
            <p class="text-muted mb-0">Kelola tipe kamar dan paket harga</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Tipe Kamar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($rooms->count())
    <!-- Enhanced Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2 text-primary"></i>Tipe Kamar Tersedia
                        <span class="badge bg-primary ms-2">{{ $rooms->count() }} kamar</span>
                    </h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari tipe kamar..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="roomsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-bed me-2 text-primary"></i>Nama Kamar
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-expand-arrows-alt me-2 text-primary"></i>Luas
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-concierge-bell me-2 text-primary"></i>Fasilitas
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-tag me-2 text-primary"></i>Harga Publish
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-briefcase me-2 text-primary"></i>Harga Corporate
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-calendar me-2 text-primary"></i>Periode
                            </th>
                            <th class="border-0 fw-semibold py-3">
                                <i class="fas fa-image me-2 text-primary"></i>Foto
                            </th>
                            <th class="border-0 fw-semibold py-3 text-center">
                                <i class="fas fa-cog me-2 text-primary"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $r)
                        <tr class="room-row">
                            <td class="align-middle py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-bed text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $r->name }}</h6>
                                        <small class="text-muted">ID: #{{ $r->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle py-3">
                                <span class="badge bg-info fs-6 px-3 py-2">
                                    <i class="fas fa-ruler-combined me-1"></i>{{ $r->size }}
                                </span>
                            </td>
                            <td class="align-middle py-3">
                                <div class="facilities-container">
                                    @if($r->facilities && count($r->facilities) > 0)
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach(array_slice($r->facilities, 0, 2) as $facility)
                                                <span class="badge bg-light text-dark border fs-6">
                                                    <i class="fas fa-check me-1"></i>{{ $facility }}
                                                </span>
                                            @endforeach
                                            @if(count($r->facilities) > 2)
                                                <span class="badge bg-secondary fs-6" 
                                                      title="{{ implode(', ', array_slice($r->facilities, 2)) }}">
                                                    +{{ count($r->facilities) - 2 }} lainnya
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">
                                            <i class="fas fa-minus me-1"></i>Tidak ada fasilitas
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle py-3">
                                <div class="price-container">
                                    <span class="fw-bold text-success fs-5">
                                        Rp{{ number_format($r->publish_rate, 0, ',', '.') }}
                                    </span>
                                    <small class="text-muted d-block">per malam</small>
                                </div>
                            </td>
                            <td class="align-middle py-3">
                                <div class="price-container">
                                    <span class="fw-bold text-info fs-5">
                                        Rp{{ number_format($r->corporate_rate, 0, ',', '.') }}
                                    </span>
                                    <small class="text-muted d-block">per malam</small>
                                </div>
                            </td>
                            <td class="align-middle py-3">
                                <div class="period-container">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                        <small class="fw-semibold">{{ $r->start_date }}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check text-muted me-2"></i>
                                        <small class="fw-semibold">{{ $r->end_date }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle py-3">
                                @if($r->photo)
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $r->photo) }}" 
                                             class="img-thumbnail cursor-pointer shadow-sm" 
                                             width="80" height="80" 
                                             style="object-fit: cover; border-radius: 8px;"
                                             onclick="showImageModal('{{ asset('storage/' . $r->photo) }}', '{{ $r->name }}')"
                                             title="Klik untuk memperbesar">
                                        <div class="position-absolute top-0 end-0 translate-middle">
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="fas fa-search-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" 
                                         style="width: 80px; height: 80px;">
                                        <div class="text-center">
                                            <i class="fas fa-image text-muted fa-2x mb-1"></i>
                                            <small class="text-muted d-block">No Photo</small>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle py-3 text-center">
                                <div class="btn-group-vertical btn-group-sm" role="group">
                                    <a href="{{ route('rooms.edit', $r) }}" 
                                       class="btn btn-warning btn-sm mb-1" 
                                       title="Edit Kamar">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm" 
                                            title="Hapus Kamar"
                                            onclick="deleteRoom({{ $r->id }}, '{{ $r->name }}')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Table Footer with Summary -->
        <div class="card-footer bg-light border-top">
            <div class="row text-center">
                <div class="col-md-3">
                    <small class="text-muted">Total Kamar</small>
                    <div class="fw-bold text-primary">{{ $rooms->count() }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Rata-rata Harga Publish</small>
                    <div class="fw-bold text-success">Rp{{ number_format($rooms->avg('publish_rate'), 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Rata-rata Harga Corporate</small>
                    <div class="fw-bold text-info">Rp{{ number_format($rooms->avg('corporate_rate'), 0, ',', '.') }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Total Fasilitas</small>
                    <div class="fw-bold text-warning">{{ $rooms->sum(function($room) { return count($room->facilities ?? []); }) }}</div>
                </div>
            </div>
        </div>
    </div>
    
    @else
    <!-- Empty State -->
    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">
            <div class="text-muted">
                <i class="fas fa-bed fa-4x mb-3 opacity-50"></i>
                <h4>Belum ada tipe kamar</h4>
                <p class="mb-4">Mulai dengan menambahkan tipe kamar pertama untuk hotel Anda</p>
                <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Tipe Kamar Pertama
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title" id="imageModalTitle">
                    <i class="fas fa-image me-2"></i>Foto Kamar
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus tipe kamar <strong id="roomName" class="text-danger"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Ya, Hapus Kamar
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
    transform: scale(1.01);
    transition: all 0.2s ease;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.cursor-pointer {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.cursor-pointer:hover {
    transform: scale(1.05);
}

.facilities-container .badge {
    font-size: 0.75em;
    padding: 0.375rem 0.75rem;
}

.price-container {
    min-width: 120px;
}

.period-container {
    min-width: 140px;
}

.btn-group-vertical .btn {
    border-radius: 0.375rem !important;
    margin-bottom: 0.25rem;
}

.btn-group-vertical .btn:last-child {
    margin-bottom: 0;
}

.img-thumbnail {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    border-color: #007bff;
    box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.25);
}

.opacity-50 {
    opacity: 0.5;
}

@media (max-width: 768px) {
    .btn-group-vertical {
        width: 100%;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .facilities-container .badge {
        font-size: 0.7em;
    }
    
    .card-footer .row .col-md-3 {
        margin-bottom: 1rem;
    }
}

/* Custom scrollbar for table */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('.room-row');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update counter
    const visibleRows = document.querySelectorAll('.room-row[style=""]').length || 
                       document.querySelectorAll('.room-row:not([style*="display: none"])').length;
    
    // You could add a counter here if needed
});

// Image modal
function showImageModal(imageSrc, roomName) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalTitle').innerHTML = '<i class="fas fa-image me-2"></i>Foto ' + roomName;
    
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Delete confirmation
function deleteRoom(roomId, roomName) {
    document.getElementById('roomName').textContent = roomName;
    document.getElementById('deleteForm').action = `/rooms/${roomId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Enhanced tooltips for facilities
document.addEventListener('DOMContentLoaded', function() {
    const facilityBadges = document.querySelectorAll('.facilities-container .badge[title]');
    facilityBadges.forEach(badge => {
        new bootstrap.Tooltip(badge);
    });
});
</script>
@endsection