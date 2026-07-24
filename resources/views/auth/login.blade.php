@extends('layouts.app')
@section('content')
<style>

    
    .login-wrapper {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .login-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
    }
    
    .card-header {
        background: var(--primary-gradient);
        color: var(--text-primary);
        padding: 30px;
        text-align: center;
        font-size: 28px;
        font-weight: 700;
        font-family: 'Orbitron', monospace;
        border: none;
        box-shadow: var(--glow-pink);
    }
    
    .card-body {
        padding: 40px 35px;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 10px;
        font-size: 14px;
    }
    
    .form-control {
        padding: 14px 16px;
        background: var(--dark-bg);
        border: 2px solid var(--dark-border);
        border-radius: 10px;
        color: var(--text-primary);
        transition: all 0.3s ease;
        font-size: 15px;
    }
    
    .form-control:focus {
        background: var(--dark-bg);
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 0.2rem rgba(255, 45, 95, 0.25);
        color: var(--text-primary);
        outline: none;
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
    }
    
    .form-check-input {
        background: var(--dark-bg);
        border: 2px solid var(--dark-border);
        cursor: pointer;
    }
    
    .form-check-input:checked {
        background: var(--primary-pink);
        border-color: var(--primary-pink);
    }
    
    .form-check-label {
        color: var(--text-secondary);
        cursor: pointer;
    }
    
    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        padding: 14px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 100%;
        box-shadow: var(--glow-pink);
        font-family: 'Orbitron', monospace;
        letter-spacing: 0.5px;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(255, 45, 95, 0.5);
    }
    
    .btn-link {
        color: var(--primary-pink);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .btn-link:hover {
        color: var(--primary-coral);
        text-decoration: none;
        text-shadow: var(--glow-pink);
    }
    
    .invalid-feedback {
        color: var(--danger);
        font-size: 13px;
        margin-top: 6px;
    }
    
    .is-invalid {
        border-color: var(--danger) !important;
    }
    
    .text-center {
        text-align: center;
    }
    
    .mb-4 {
        margin-bottom: 1.5rem;
    }
    
    .d-grid {
        display: grid;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h1 class="card-header" style="margin: 0;">
            Login
        </h1>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus
                           placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary">
                        LOGIN
                    </button>
                </div>
                
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection