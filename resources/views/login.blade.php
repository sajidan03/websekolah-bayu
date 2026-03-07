@extends('layouts.app')
@section('title', 'Login')

@section('content')
<style>
    :root {
        --primary: #2c3e50;
        --secondary: #34495e;
        --accent: #f1c40f;
        --dark: #1a2634;
        --light: #ecf0f1;
        --muted: #95a5a6;
    }

    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(145deg, #0f2027, #203a43, #2c5364);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* Efek sangat minimalis - hanya beberapa titik */
    .subtle-dots {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
        z-index: 0;
    }

    /* Bulan kecil sebagai aksen */
    .moon-accsent {
        position: fixed;
        top: 40px;
        right: 60px;
        width: 30px;
        height: 30px;
        background: transparent;
        border-radius: 50%;
        box-shadow: -6px -3px 0 0 rgba(255, 255, 255, 0.4);
        transform: rotate(15deg);
        z-index: 0;
        pointer-events: none;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        padding: 1.5rem;
    }

    .login-card {
        width: 400px;
        padding: 2.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .login-header h2 {
        color: #2c3e50;
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
        letter-spacing: -0.5px;
    }

    .login-header p {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .alert {
        background: #fef2f2;
        border: 1px solid #fee2e2;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        color: #b91c1c;
        font-size: 0.85rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-control {
        width: 100%;
        padding: 0.9rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.2s;
        background: #f8fafc;
    }

    .form-control:focus {
        outline: none;
        border-color: #f1c40f;
        background: white;
        box-shadow: 0 0 0 3px rgba(241, 196, 15, 0.1);
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .btn-login {
        width: 100%;
        padding: 0.9rem;
        background: #2c3e50;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 0.5rem;
    }

    .btn-login:hover {
        background: #34495e;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .login-footer {
        margin-top: 2rem;
        text-align: center;
    }

    .security-note {
        color: #94a3b8;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .security-note svg {
        width: 12px;
        height: 12px;
        fill: #f1c40f;
    }

    /* Responsive */
    @media (max-width: 480px) {
        .login-card {
            padding: 2rem 1.5rem;
        }
        
        .moon-accsent {
            display: none;
        }
    }
</style>

<!-- Efek sangat minimalis -->
<div class="subtle-dots"></div>
<div class="moon-accsent"></div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <h2>Admin Panel</h2>
            <p>Silakan masuk untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Username"
                       required
                       autofocus>
            </div>

            <div class="form-group">
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Password"
                       required>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

        <div class="login-footer">
            <div class="security-note">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>Akses terbatas • Semua aktivitas tercatat</span>
            </div>
        </div>
    </div>
</div>
@endsection