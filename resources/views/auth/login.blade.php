@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center login-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="login-card">
                    <!-- Logo Circle -->
                    <!-- <div class="logo-circle">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="logo-img">
                    </div> -->
                    
                    <!-- Card Content -->
                    <div class="card-content">
                        <div class="text-center mb-4">
                            <h2 class="login-title">Welcome Back</h2>
                            <p class="login-subtitle">Please sign in to your account</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    {{ __('Email Address') }}
                                </label>
                                <div class="input-wrapper">
                                    <div class="input-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <input id="email" 
                                           type="email" 
                                           class="form-input @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autocomplete="email" 
                                           autofocus
                                           placeholder="Enter your email address">
                                </div>
                                @error('email')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    {{ __('Password') }}
                                </label>
                                <div class="input-wrapper">
                                    <div class="input-icon">
                                        <i class="bi bi-lock"></i>
                                    </div>
                                    <input id="password" 
                                           type="password" 
                                           class="form-input @error('password') is-invalid @enderror" 
                                           name="password" 
                                           required 
                                           autocomplete="current-password"
                                           placeholder="Enter your password">
                                    <button class="password-toggle" type="button" id="togglePassword">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="form-options">
                                <div class="remember-me">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-password">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="login-btn">
                                <span class="btn-text">Sign In</span>
                                <i class="bi bi-arrow-right btn-icon"></i>
                            </button>
                        </form>

                        <!-- Additional Links -->
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Background */
.login-background {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.login-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Main Card */
.login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Logo Circle */
.logo-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    z-index: 10;
}

.logo-img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}

/* Card Content */
.card-content {
    padding: 60px 40px 40px;
}

/* Typography */
.login-title {
    font-size: 28px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
}

.login-subtitle {
    color: #718096;
    font-size: 16px;
    margin-bottom: 0;
}

/* Form Groups */
.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
    font-size: 14px;
    letter-spacing: 0.3px;
}

/* Input Wrapper */
.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon {
    position: absolute;
    left: 16px;
    color: #a0aec0;
    z-index: 2;
    font-size: 16px;
}

.form-input {
    width: 100%;
    height: 52px;
    padding: 0 20px 0 48px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 16px;
    background: #ffffff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
}

.form-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-input.is-invalid {
    border-color: #e53e3e;
    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
}

.form-input::placeholder {
    color: #a0aec0;
}

/* Password Toggle */
.password-toggle {
    position: absolute;
    right: 16px;
    background: none;
    border: none;
    color: #a0aec0;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
    z-index: 2;
}

.password-toggle:hover {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

/* Error Messages */
.error-message {
    color: #e53e3e;
    font-size: 14px;
    margin-top: 6px;
    font-weight: 500;
}

/* Form Options */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 12px;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
}

.remember-me input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #667eea;
}

.remember-me label {
    color: #4a5568;
    font-size: 14px;
    cursor: pointer;
}

.forgot-password {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.2s ease;
}

.forgot-password:hover {
    color: #5a67d8;
    text-decoration: underline;
}

/* Login Button */
.login-btn {
    width: 100%;
    height: 52px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
}

.login-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.login-btn:hover::before {
    left: 100%;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.login-btn:active {
    transform: translateY(0);
}

.btn-icon {
    transition: transform 0.3s ease;
}

.login-btn:hover .btn-icon {
    transform: translateX(4px);
}

/* Additional Links */
.additional-links {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
}

.additional-links p {
    color: #718096;
    margin: 0;
    font-size: 14px;
}

.signup-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}

.signup-link:hover {
    color: #5a67d8;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 576px) {
    .card-content {
        padding: 50px 24px 32px;
    }
    
    .login-title {
        font-size: 24px;
    }
    
    .form-input {
        height: 48px;
        font-size: 15px;
    }
    
    .login-btn {
        height: 48px;
        font-size: 15px;
    }
    
    .form-options {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
}

/* Loading Animation */
.login-btn.loading {
    pointer-events: none;
}

.login-btn.loading .btn-text {
    opacity: 0;
}

.login-btn.loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (togglePassword && passwordField && toggleIcon) {
        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
    }
    
    // Form submission animation
    const form = document.querySelector('form');
    const loginBtn = document.querySelector('.login-btn');
    
    if (form && loginBtn) {
        form.addEventListener('submit', function() {
            loginBtn.classList.add('loading');
        });
    }
    
    // Input focus animations
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection