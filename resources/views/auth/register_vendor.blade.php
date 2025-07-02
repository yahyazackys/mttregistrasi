@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0 fw-bold">
                        <i class="fas fa-user-plus me-2"></i>
                        Pendaftaran Vendor
                    </h3>
                    <p class="mb-0 mt-2 opacity-75">Bergabunglah dengan mitra bisnis kami</p>
                </div>

                <div class="card-body p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.vendor') }}" id="vendorForm">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                Email Address
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}"
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pic_name" class="form-label fw-semibold">
                                <i class="fas fa-user text-primary me-2"></i>
                                Nama PIC (Person In Charge)
                            </label>
                            <input type="text" 
                                   name="pic_name" 
                                   id="pic_name"
                                   class="form-control form-control-lg @error('pic_name') is-invalid @enderror" 
                                   value="{{ old('pic_name') }}"
                                   placeholder="Masukkan nama lengkap PIC"
                                   required>
                            @error('pic_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="fas fa-phone text-primary me-2"></i>
                                Nomor Handphone
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-mobile-alt text-muted"></i>
                                </span>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone"
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone') }}"
                                       placeholder="08xxxxxxxxxx"
                                       pattern="[0-9]{10,13}"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Format: 08xxxxxxxxxx (10-13 digit)</small>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock text-primary me-2"></i>
                                Password
                            </label>
                            <div class="input-group input-group-lg">
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="Masukkan password yang kuat"
                                       minlength="8"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Minimal 8 karakter, kombinasi huruf dan angka</small>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       name="terms" 
                                       id="terms"
                                       class="form-check-input @error('terms') is-invalid @enderror" 
                                       required>
                                <label class="form-check-label" for="terms">
                                    Saya setuju dengan 
                                    <a href="#" class="text-primary text-decoration-none fw-semibold" data-bs-toggle="modal" data-bs-target="#termsModal">
                                        syarat & ketentuan
                                    </a> 
                                    yang berlaku
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-semibold py-3">
                                <i class="fas fa-user-check me-2"></i>
                                Daftar Sebagai Vendor
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-0">
                                Sudah memiliki akun? 
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">
                                    Masuk di sini
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="card mt-4 border-0 bg-light">
                <div class="card-body text-center py-4">
                    <h6 class="fw-semibold text-muted mb-3">
                        <i class="fas fa-question-circle me-2"></i>
                        Butuh Bantuan?
                    </h6>
                    <div class="row">
                        <div class="col-md-4">
                            <i class="fas fa-phone-alt text-primary fs-4 mb-2"></i>
                            <p class="small mb-0">Telepon</p>
                            <p class="small text-muted">021-1234-5678</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-envelope text-primary fs-4 mb-2"></i>
                            <p class="small mb-0">Email</p>
                            <p class="small text-muted">support@company.com</p>
                        </div>
                        <div class="col-md-4">
                            <i class="fas fa-clock text-primary fs-4 mb-2"></i>
                            <p class="small mb-0">Jam Operasional</p>
                            <p class="small text-muted">08:00 - 17:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="termsModalLabel">
                    <i class="fas fa-file-contract me-2"></i>
                    Syarat & Ketentuan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>1. Ketentuan Umum</h6>
                <p>Dengan mendaftar sebagai vendor, Anda menyetujui untuk mematuhi semua ketentuan yang berlaku...</p>
                
                <h6>2. Kewajiban Vendor</h6>
                <p>Vendor wajib menyediakan produk/layanan sesuai dengan standar kualitas yang telah ditetapkan...</p>
                
                <h6>3. Kebijakan Pembayaran</h6>
                <p>Pembayaran akan dilakukan sesuai dengan terms of payment yang telah disepakati...</p>
                
                <!-- Add more terms as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="acceptTerms()">Saya Setuju</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        transition: transform 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    .input-group-text {
        border-right: none;
    }
    
    .input-group .form-control {
        border-left: none;
    }
    
    .input-group .form-control:focus {
        border-left: none;
    }
</style>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    // Accept terms function
    function acceptTerms() {
        document.getElementById('terms').checked = true;
        const modal = bootstrap.Modal.getInstance(document.getElementById('termsModal'));
        modal.hide();
    }

    // Form validation enhancement
    document.getElementById('vendorForm').addEventListener('submit', function(e) {
        const phone = document.getElementById('phone').value;
        const phonePattern = /^[0-9]{10,13}$/;
        
        if (!phonePattern.test(phone)) {
            e.preventDefault();
            alert('Format nomor handphone tidak valid. Gunakan format: 08xxxxxxxxxx');
            return false;
        }
    });

    // Auto-format phone number
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            value = value.substring(0, 13);
        }
        e.target.value = value;
    });
</script>
@endsection