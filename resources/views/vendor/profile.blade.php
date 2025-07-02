@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-tie me-2"></i>
                        Data Diri Vendor
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Information -->
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong class="text-muted">
                                        <i class="fas fa-user me-2"></i>Nama
                                    </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span class="fw-bold">{{ $vendor->pic_name ?? $vendor->name }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong class="text-muted">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span>{{ $vendor->email }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong class="text-muted">
                                        <i class="fas fa-phone me-2"></i>Telepon
                                    </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span>{{ $vendor->phone }}</span>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong class="text-muted">
                                        <i class="fas fa-calendar-alt me-2"></i>Waktu Daftar
                                    </strong>
                                </div>
                                <div class="col-sm-8">
                                    <span>{{ $vendor->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status Cards -->
                        <div class="col-md-4">
                            <div class="card bg-light h-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title text-muted mb-3">Status Informasi</h6>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Verifikasi</small>
                                        <span class="badge bg-info fs-6">{{ $vendor->status }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Status Akun</small>
                                        @if ($vendor->hasVerifiedEmail())
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-danger fs-6">
                                                <i class="fas fa-exclamation-circle me-1"></i>Belum Verifikasi
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <small class="text-muted d-block">Terms & Conditions</small>
                                        @if($vendor->terms_agreed)
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check me-1"></i>Disetujui
                                            </span>
                                        @else
                                            <span class="badge bg-warning fs-6">
                                                <i class="fas fa-times me-1"></i>Belum Disetujui
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Dokumen
                    </h5>
                </div>
                <div class="card-body">
                    @if($vendor->document_file)
                        <div class="d-flex align-items-center justify-content-between p-3 border rounded bg-light">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger fs-4 me-3"></i>
                                <div>
                                    <h6 class="mb-1">Dokumen Terunggah</h6>
                                    <small class="text-muted">Klik untuk melihat dokumen</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $vendor->document_file) }}" target="_blank" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Lihat Dokumen
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-upload text-muted fs-1 mb-3"></i>
                            <p class="text-muted mb-0">Belum ada dokumen yang diunggah</p>
                            <small class="text-muted">Upload dokumen melalui form di bawah</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Edit Form Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Informasi
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pic_name" class="form-label fw-bold">
                                        <i class="fas fa-user me-2 text-primary"></i>Nama PIC
                                    </label>
                                    <input type="text" name="pic_name" id="pic_name" 
                                           class="form-control form-control-lg" 
                                           value="{{ old('pic_name', auth()->user()->pic_name) }}" 
                                           placeholder="Masukkan nama PIC"
                                           required>
                                    @error('pic_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="fas fa-phone me-2 text-primary"></i>Telepon
                                    </label>
                                    <input type="text" name="phone" id="phone" 
                                           class="form-control form-control-lg" 
                                           value="{{ old('phone', auth()->user()->phone) }}" 
                                           placeholder="Masukkan nomor telepon"
                                           required>
                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="document_file" class="form-label fw-bold">
                                <i class="fas fa-cloud-upload-alt me-2 text-primary"></i>Upload Dokumen
                            </label>
                            <input type="file" name="document_file" id="document_file" 
                                   class="form-control form-control-lg" 
                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format yang didukung: PDF, DOC, DOCX, JPG, JPEG, PNG (Maksimal 5MB)
                            </div>
                            @if (auth()->user()->document_file)
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Dokumen saat ini: 
                                        <a href="{{ asset('storage/' . auth()->user()->document_file) }}" 
                                           target="_blank" class="text-decoration-none">
                                            Lihat File <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    </small>
                                </div>
                            @endif
                            @error('document_file')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-light btn-lg" onclick="history.back()">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </button>
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
    }
    
    .card-header {
        border-radius: 12px 12px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .row > div {
        margin-bottom: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        .col-sm-4, .col-sm-8 {
            margin-bottom: 0.5rem;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // File upload preview
    document.getElementById('document_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            const fileName = file.name;
            
            // Create preview element
            let preview = document.getElementById('file-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'file-preview';
                preview.className = 'mt-2 p-2 bg-light rounded';
                e.target.parentNode.appendChild(preview);
            }
            
            preview.innerHTML = `
                <small class="text-success">
                    <i class="fas fa-file me-1"></i>
                    File dipilih: <strong>${fileName}</strong> (${fileSize} MB)
                </small>
            `;
        }
    });
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const picName = document.getElementById('pic_name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        
        if (!picName || !phone) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Re-enable button after 5 seconds (fallback)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });
</script>
@endpush
@endsection