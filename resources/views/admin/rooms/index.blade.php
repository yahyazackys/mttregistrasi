@extends('layouts.app')

@section('content')
<div class="rooms-dashboard">
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="dashboard-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="header-icon me-3">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div>
                            <h2 class="header-title mb-1">Manajemen Kamar</h2>
                            <p class="header-subtitle mb-0">Kelola semua kamar hotel dan fasilitas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="header-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ count($rooms) }}</span>
                            <span class="stat-label">Total Kamar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Action Bar -->
        <div class="action-bar mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="action-buttons">
                        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Kamar
                        </a>
                        <a href="{{ route('admin.rooms.export.pdf', request()->only('hotel_id')) }}" 
                           class="btn btn-outline-secondary">
                            <i class="fas fa-file-pdf me-1"></i>
                            Export PDF
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <form method="GET" class="filter-form">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-filter"></i>
                            </span>
                            <select name="hotel_id" class="form-select" onchange="this.form.submit()">
                                <option value="">-- Semua Hotel --</option>
                                @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h5 class="mb-0">
                    <i class="fas fa-table me-2"></i>
                    Daftar Kamar
                    @if(request('hotel_id'))
                        <span class="badge bg-primary ms-2">
                            {{ $hotels->find(request('hotel_id'))->name ?? 'Hotel Terpilih' }}
                        </span>
                    @endif
                </h5>
                <div class="table-actions">
                    <button class="btn btn-sm btn-outline-secondary me-2" onclick="refreshTable()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table rooms-table" id="roomsTable">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input" id="selectAll" onchange="toggleSelectAll()">
                            </th>
                            <th>
                                <div class="th-content">
                                    <i class="fas fa-hotel me-2"></i>
                                    Hotel
                                </div>
                            </th>
                            <th>
                                <div class="th-content">
                                    <i class="fas fa-door-open me-2"></i>
                                    Nama Kamar
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-expand-arrows-alt me-2"></i>
                                    Luas
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-concierge-bell me-2"></i>
                                    Fasilitas
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-tag me-2"></i>
                                    Harga
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-calendar me-2"></i>
                                    Periode
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-image me-2"></i>
                                    Foto
                                </div>
                            </th>
                            <th class="text-center">
                                <div class="th-content">
                                    <i class="fas fa-cogs me-2"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $r)
                        <tr class="room-row" data-room-id="{{ $r->id }}">
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input room-checkbox" value="{{ $r->id }}">
                            </td>
                            <td>
                                <div class="hotel-info">
                                    <div class="hotel-badge">
                                        {{ substr($r->hotel->name, 0, 2) }}
                                    </div>
                                    <div class="hotel-name">{{ $r->hotel->name }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="room-name">
                                    <strong>{{ $r->name }}</strong>
                                    <div class="room-code text-muted small">
                                        ID: {{ $r->id }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="size-badge">
                                    <span class="size-number">{{ $r->size }}</span>
                                    <span class="size-unit">m²</span>
                                </div>
                            </td>
                            <td>
                                <div class="facilities-container">
                                    @if(is_array($r->facilities) && count($r->facilities) > 0)
                                        @foreach(array_slice($r->facilities, 0, 3) as $facility)
                                            <span class="facility-badge">{{ $facility }}</span>
                                        @endforeach
                                        @if(count($r->facilities) > 3)
                                            <span class="facility-badge more-badge" 
                                                  title="{{ implode(', ', array_slice($r->facilities, 3)) }}">
                                                +{{ count($r->facilities) - 3 }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="price-container">
                                    <div class="price-item">
                                        <span class="price-label">Publish</span>
                                        <span class="price-value publish">Rp{{ number_format($r->publish_rate, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="price-item">
                                        <span class="price-label">Corporate</span>
                                        <span class="price-value corporate">Rp{{ number_format($r->corporate_rate, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="period-container">
                                    <div class="date-badge start">
                                        <i class="fas fa-play me-1"></i>
                                        {{ \Carbon\Carbon::parse($r->start_date)->format('d/m/Y') }}
                                    </div>
                                    <div class="date-separator">
                                        <i class="fas fa-arrow-down"></i>
                                    </div>
                                    <div class="date-badge end">
                                        <i class="fas fa-stop me-1"></i>
                                        {{ \Carbon\Carbon::parse($r->end_date)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="photo-container">
                                    @if($r->photo)
                                        <div class="photo-preview" onclick="showPhotoModal('{{ asset('storage/' . $r->photo) }}', '{{ $r->name }}')">
                                            <img src="{{ asset('storage/' . $r->photo) }}" 
                                                 alt="Foto {{ $r->name }}"
                                                 class="room-photo">
                                            <div class="photo-overlay">
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                        </div>
                                    @else
                                        <div class="no-photo">
                                            <i class="fas fa-camera-retro"></i>
                                            <span>Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <div class="btn-group-vertical" role="group">
                                        <a href="{{ route('admin.rooms.edit', $r->id) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           title="Edit Kamar">
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteRoom({{ $r->id }}, '{{ $r->name }}')"
                                                title="Hapus Kamar">
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if(count($rooms) === 0)
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h5>Belum ada kamar terdaftar</h5>
                    <p class="text-muted">
                        @if(request('hotel_id'))
                            Hotel yang dipilih belum memiliki kamar
                        @else
                            Kamar yang didaftarkan akan muncul di sini
                        @endif
                    </p>
                    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Kamar Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Photo Modal -->
<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalTitle">Foto Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhoto" src="" alt="Foto Kamar" class="img-fluid rounded">
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
                <p>Apakah Anda yakin ingin menghapus kamar <strong id="roomName"></strong>?</p>
                <p class="text-muted small">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait kamar.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        Hapus Kamar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.rooms-dashboard {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 2rem 0;
}

.dashboard-header {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.header-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.header-title {
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
}

.header-subtitle {
    color: #6c757d;
    font-size: 0.95rem;
}

.custom-alert {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(40, 167, 69, 0.2);
}

.action-bar {
    background: white;
    padding: 1.5rem;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 500;
}

.filter-form .input-group-text {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    color: #6c757d;
}

.filter-form .form-select {
    border: 2px solid #e9ecef;
    border-left: none;
}

.table-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    overflow: hidden;
}

.table-header {
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
}

.table-header h5 {
    color: #2c3e50;
    font-weight: 600;
}

.rooms-table {
    margin: 0;
}

.rooms-table thead th {
    background: #f8f9fa;
    border: none;
    padding: 1.5rem 1rem;
    font-weight: 600;
    color: #495057;
    vertical-align: middle;
}

.th-content {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.rooms-table tbody td {
    padding: 1.5rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.room-row {
    transition: all 0.3s ease;
}

.room-row:hover {
    background-color: #f8f9fa;
}

.hotel-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.hotel-badge {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 0.9rem;
}

.hotel-name {
    font-weight: 600;
    color: #2c3e50;
}

.room-name strong {
    color: #2c3e50;
}

.room-code {
    font-size: 0.8rem;
    color: #6c757d;
}

.size-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #e3f2fd;
    padding: 0.5rem;
    border-radius: 8px;
    color: #1976d2;
}

.size-number {
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1;
}

.size-unit {
    font-size: 0.8rem;
    opacity: 0.8;
}

.facilities-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    max-width: 200px;
}

.facility-badge {
    background: #e8f5e8;
    color: #2e7d32;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.more-badge {
    background: #f3e5f5;
    color: #7b1fa2;
    cursor: help;
}

.price-container {
    text-align: right;
}

.price-item {
    margin-bottom: 0.5rem;
}

.price-label {
    display: block;
    font-size: 0.75rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.price-value {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
}

.price-value.publish {
    color: #dc3545;
}

.price-value.corporate {
    color: #28a745;
}

.period-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.date-badge {
    background: #fff3cd;
    color: #856404;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
}

.date-badge.start {
    background: #d4edda;
    color: #155724;
}

.date-badge.end {
    background: #f8d7da;
    color: #721c24;
}

.date-separator {
    color: #6c757d;
    font-size: 0.8rem;
}

.photo-container {
    display: flex;
    justify-content: center;
}

.photo-preview {
    position: relative;
    width: 80px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.room-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.photo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
}

.photo-preview:hover .photo-overlay {
    opacity: 1;
}

.photo-preview:hover .room-photo {
    transform: scale(1.1);
}

.no-photo {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #6c757d;
    font-size: 0.8rem;
}

.no-photo i {
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
}

.action-buttons {
    display: flex;
    justify-content: center;
}

.action-buttons .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1rem;
}

.empty-state h5 {
    color: #6c757d;
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .rooms-table {
        font-size: 0.85rem;
    }
    
    .rooms-table td {
        padding: 1rem 0.5rem;
    }
    
    .facilities-container {
        max-width: 150px;
    }
    
    .photo-preview {
        width: 60px;
        height: 45px;
    }
    
    .action-buttons .btn-group-vertical {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>

<script>
// Select all functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.room-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

// Photo modal
function showPhotoModal(photoUrl, roomName) {
    document.getElementById('photoModalTitle').textContent = `Foto - ${roomName}`;
    document.getElementById('modalPhoto').src = photoUrl;
    new bootstrap.Modal(document.getElementById('photoModal')).show();
}

// Delete room function
function deleteRoom(roomId, roomName) {
    document.getElementById('roomName').textContent = roomName;
    document.getElementById('deleteForm').action = `/admin/rooms/${roomId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Refresh table
function refreshTable() {
    window.location.reload();
}

// Select all function
function selectAll() {
    document.getElementById('selectAll').checked = true;
    toggleSelectAll();
}

// Export selected function
function exportSelected() {
    const selected = Array.from(document.querySelectorAll('.room-checkbox:checked')).map(cb => cb.value);
    if (selected.length === 0) {
        alert('Pilih minimal satu kamar untuk diekspor');
        return;
    }
    console.log('Export selected rooms:', selected);
    // Implement export functionality
}
</script>
@endsection