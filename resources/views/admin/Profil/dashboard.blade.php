@extends('Layouts-Admin.app')
@section('title', 'Profil - Dashboard')
@section('content')

<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Profil Sekolah</h1>
        <p class="text-secondary fs-5">Ketahui lebih dalam tentang SMK-Ucup</p>
        <div class="divider mx-auto"></div>
    </div>

    <!-- Menu Cards Grid -->
    <div class="row g-4">
        @foreach($profils as $index => $profil)
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('profil.menu', $profil->nama_menu) }}" class="text-decoration-none">
                <div class="profil-card h-100">
                    <div class="card-icon">
                        @switch($profil->nama_menu)
                            @case('sambutan')
                                <span>👨‍🏫</span>
                                @break
                            @case('visi-misi')
                                <span>🎯</span>
                                @break
                            @case('struktur-organisasi')
                                <span>🏛️</span>
                                @break
                            @case('sejarah')
                                <span>📜</span>
                                @break
                            @default
                                <span>📋</span>
                        @endswitch
                    </div>
                    <h3 class="card-title">{{ $profil->judul }}</h3>
                    <p class="card-text">
                        Klik untuk melihat detail {{ strtolower($profil->judul) }}
                    </p>
                    <div class="card-arrow">
                        <span>→</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- Back to Home -->
    <div class="text-center mt-5">
        <a href="/" class="btn-back">
            ← Kembali ke Halaman Utama
        </a>
    </div>
</div>

<style>
/* Container & Layout */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Header Styles */
.text-center {
    text-align: center;
}

.fw-bold {
    font-weight: 700;
}

.text-secondary {
    color: #6c757d;
}

.fs-5 {
    font-size: 1.25rem;
}

/* Divider */
.divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
    margin-top: 20px;
}

/* Card Grid */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: -15px;
}

.g-4 {
    gap: 1.5rem;
}

.col-md-6, .col-lg-3 {
    padding: 15px;
    position: relative;
    width: 100%;
}

@media (min-width: 768px) {
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (min-width: 992px) {
    .col-lg-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }
}

/* Profil Card */
.profil-card {
    background: white;
    border-radius: 20px;
    padding: 30px 25px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 2px solid transparent;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.profil-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.profil-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
    border-color: #667eea;
}

.profil-card:hover::before {
    transform: scaleX(1);
}

/* Card Icon */
.card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 35px;
    transition: transform 0.4s ease;
}

.profil-card:hover .card-icon {
    transform: scale(1.1) rotate(5deg);
}

/* Card Title */
.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
}

/* Card Text */
.card-text {
    color: #7f8c8d;
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.5;
}

/* Card Arrow */
.card-arrow {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: auto;
    transition: all 0.3s ease;
    color: #667eea;
    font-weight: bold;
}

.profil-card:hover .card-arrow {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateX(5px);
}

/* Back Button */
.btn-back {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

/* Text Decoration */
.text-decoration-none {
    text-decoration: none;
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.profil-card {
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: {{ $index * 0.1 }}s;
    opacity: 0;
}
</style>

@endsection
