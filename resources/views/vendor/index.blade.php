@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="fas fa-building text-primary me-2"></i>
                Daftar Vendor
            </h2>
            <p class="text-muted mb-0">Kelola dan pantau vendor yang terdaftar</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-light text-dark fs-6 px-3 py-2">
                Total: {{ $vendors->count() }} vendor
            </span>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-filter text-primary me-2"></i>
                Filter & Export
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.vendors.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="from" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                        Dari Tanggal
                    </label>
                    <input type="date" name="from" id="from" class="form-control border-2" value="{{ request('from') }}">
                </div>
                <div class="col-md-3">
                    <label for="to" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                        Sampai Tanggal
                    </label>
                    <input type="date" name="to" id="to" class="form-control border-2" value="{{ request('to') }}">
                </div>
                <div class="col-md-6 align-self-end">
                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <a href="{{ route('admin.vendor.export', ['from' => request('from'), 'to' => request('to')]) }}" 
                           class="btn btn-success px-4">
                            <i class="fas fa-file-excel me-2"></i>Export Excel
                        </a>
                        @if(request('from') || request('to'))
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Vendors Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="card-title mb-0">
                <i class="fas fa-table text-primary me-2"></i>
                Data Vendor
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 py-3 px-4">
                                <i class="fas fa-user me-2 text-muted"></i>
                                Nama PIC
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-envelope me-2 text-muted"></i>
                                Email
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-phone me-2 text-muted"></i>
                                Telepon
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-calendar me-2 text-muted"></i>
                                Tanggal Registrasi
                            </th>
                            <th class="border-0 py-3 text-center">
                                <i class="fas fa-info-circle me-2 text-muted"></i>
                                Status
                            </th>
                            <th class="border-0 py-3 text-center">
                                <i class="fas fa-cog me-2 text-muted"></i>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr class="border-bottom">
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $vendor->pic_name }}</div>
                                            <small class="text-muted">PIC Vendor</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-muted me-2"></i>
                                        <span class="text-dark">{{ $vendor->email }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-muted me-2"></i>
                                        <span class="text-dark">{{ $vendor->phone }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-muted me-2"></i>
                                        <span class="text-dark">{{ $vendor->created_at->format('d-m-Y') }}</span>
                                        <br>
                                        <small class="text-muted">{{ $vendor->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="py-3 text-center">
                                    <form method="POST" action="{{ route('admin.vendor.status.update', $vendor->id) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="form-select form-select-sm border-2 status-select" 
                                                data-status="{{ $vendor->status }}">
                                            <option value="pending" {{ $vendor->status === 'pending' ? 'selected' : '' }}>
                                                🟡 Pending
                                            </option>
                                            <option value="approved" {{ $vendor->status === 'approved' ? 'selected' : '' }}>
                                                🟢 Approved
                                            </option>
                                            <option value="rejected" {{ $vendor->status === 'rejected' ? 'selected' : '' }}>
                                                🔴 Rejected
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.vendor.show', $vendor->id) }}" 
                                       class="btn btn-outline-primary btn-sm px-3" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail Vendor">
                                        <i class="fas fa-eye me-1"></i>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak ada vendor ditemukan</h5>
                                        <p class="text-muted mb-0">Belum ada vendor yang terdaftar atau sesuai dengan filter yang dipilih.</p>
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

<style>
    .status-select {
        min-width: 120px;
        font-size: 0.875rem;
    }
    
    .status-select[data-status="pending"] {
        background-color: #fff3cd;
        border-color: #ffc107;
        color: #856404;
    }
    
    .status-select[data-status="approved"] {
        background-color: #d1edff;
        border-color: #198754;
        color: #0f5132;
    }
    
    .status-select[data-status="rejected"] {
        background-color: #f8d7da;
        border-color: #dc3545;
        color: #721c24;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .card {
        border-radius: 12px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
    }
    
    .bg-primary.bg-opacity-10 {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Add confirmation for status changes
        document.querySelectorAll('.status-select').forEach(function(select) {
            select.addEventListener('change', function(e) {
                const status = this.value;
                const statusText = this.options[this.selectedIndex].text;
                
                if (!confirm(`Apakah Anda yakin ingin mengubah status menjadi ${statusText}?`)) {
                    // Reset to previous value
                    this.value = this.dataset.status;
                    e.preventDefault();
                    return false;
                }
            });
        });
    });
</script>
@endsection