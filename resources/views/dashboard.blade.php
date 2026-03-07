@extends('layouts.app')
@section('title', 'Profil Sekolah')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --ink:        #0d1b2a;
    --ink-mid:    #1c3144;
    --ink-soft:   #2e4a63;
    --accent:     #e8a87c;
    --accent-dark:#c4834a;
    --white:      #ffffff;
    --off-white:  #f5f3ef;
    --light-bg:   #fafaf8;
    --text-body:  #4a5568;
    --text-muted: #718096;
    --border:     #e2e8f0;
    --shadow-sm:  0 2px 8px rgba(13,27,42,0.06);
    --shadow-md:  0 8px 30px rgba(13,27,42,0.10);
    --shadow-lg:  0 20px 60px rgba(13,27,42,0.14);
    --radius:     16px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.profil-wrapper {
    font-family: 'DM Sans', sans-serif;
    background: var(--light-bg);
    min-height: 100vh;
    color: var(--text-body);
}

/* ===== HERO HEADER ===== */
.profil-hero {
    position: relative;
    background: var(--ink);
    padding: 80px 24px 72px;
    text-align: center;
    overflow: hidden;
}

.hero-bg-grid {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(232,168,124,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(232,168,124,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
}

.hero-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}
.hero-orb-1 {
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(232,168,124,0.15) 0%, transparent 70%);
    top: -80px; left: -60px;
}
.hero-orb-2 {
    width: 280px; height: 280px;
    background: radial-gradient(circle, rgba(46,74,99,0.5) 0%, transparent 70%);
    bottom: -60px; right: -40px;
}

.hero-inner {
    position: relative;
    z-index: 2;
    max-width: 640px;
    margin: 0 auto;
    animation: fadeUp 0.8s ease both;
}

.hero-eyebrow {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--accent);
    border: 1px solid rgba(232,168,124,0.3);
    padding: 6px 18px;
    border-radius: 100px;
    margin-bottom: 20px;
    background: rgba(232,168,124,0.08);
}

.hero-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2rem, 5vw, 3rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.15;
    letter-spacing: -0.5px;
    margin-bottom: 12px;
}

.hero-subtitle {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.6);
    font-style: italic;
    font-weight: 300;
}

/* ===== MAIN CONTENT ===== */
.profil-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}

/* ===== SECTION HEADER ===== */
.section-header-center {
    text-align: center;
    margin-bottom: 56px;
}

.section-header-center h2 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(1.6rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.5px;
    word-wrap: break-word;
}

.content-divider {
    width: 48px;
    height: 3px;
    background: var(--accent);
    border-radius: 3px;
    margin: 20px auto 0;
}

/* ===== MENU CARDS GRID ===== */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

@media (max-width: 992px) {
    .menu-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
}

@media (max-width: 576px) {
    /* Tetap 2 kolom di HP kecil */
    .menu-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
}

/* ===== MENU CARD ===== */
.menu-card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
}

.menu-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent), var(--accent-dark));
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.menu-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(232,168,124,0.2);
    border-color: var(--accent);
}

.menu-card:hover::before {
    transform: scaleX(1);
}

.menu-icon-wrap {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, var(--ink) 0%, var(--ink-mid) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 30px auto 20px;
    font-size: 38px;
    transition: all 0.4s ease;
}

.menu-card:hover .menu-icon-wrap {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
    transform: scale(1.1) rotate(5deg);
}

.menu-icon-wrap .icon-emoji {
    line-height: 1;
}

.menu-card-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
    padding: 0 20px;
}

.menu-card-desc {
    font-size: 0.87rem;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 24px;
    padding: 0 20px;
    flex-grow: 1;
}

.menu-arrow {
    width: 44px;
    height: 44px;
    background: var(--off-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    color: var(--ink);
    font-size: 18px;
}

.menu-card:hover .menu-arrow {
    background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
    color: var(--white);
    transform: translateX(5px);
}

/* ===== BACK BUTTON ===== */
.back-section {
    text-align: center;
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid var(--border);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: var(--ink);
    color: var(--white);
    text-decoration: none;
    border-radius: 100px;
    font-weight: 600;
    font-size: 0.92rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 18px rgba(13,27,42,0.25);
}

.btn-back:hover {
    background: var(--ink-mid);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(13,27,42,0.35);
    color: var(--white);
}

/* ===== ANIMATION ===== */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

.menu-card {
    animation: fadeUp 0.6s ease forwards;
}

/* Stagger animation for each card */
.menu-card:nth-child(1) { animation-delay: 0.1s; }
.menu-card:nth-child(2) { animation-delay: 0.2s; }
.menu-card:nth-child(3) { animation-delay: 0.3s; }
.menu-card:nth-child(4) { animation-delay: 0.4s; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .profil-hero { padding: 60px 20px 56px; }
    .profil-main { padding: 40px 16px 60px; }
    .hero-title { font-size: 1.8rem; }
    .section-header-center { margin-bottom: 36px; }
    .section-header-center h2 { font-size: clamp(1.3rem, 5vw, 1.8rem); }
    .menu-icon-wrap { width: 70px; height: 70px; font-size: 28px; margin: 22px auto 14px; }
    .menu-card-title { font-size: 0.95rem; }
    .menu-card-desc { font-size: 0.8rem; margin-bottom: 16px; }
    .menu-arrow { width: 36px; height: 36px; margin-bottom: 18px; }
}

@media (max-width: 480px) {
    .menu-grid { gap: 10px; }
    .menu-icon-wrap { width: 56px; height: 56px; font-size: 22px; margin: 18px auto 12px; }
    .menu-card-title { font-size: 0.85rem; padding: 0 12px; }
    .menu-card-desc { font-size: 0.75rem; padding: 0 12px; margin-bottom: 12px; }
    .menu-arrow { width: 32px; height: 32px; font-size: 14px; margin-bottom: 14px; }
}
</style>

<div class="profil-wrapper">

    {{-- HERO --}}
    <section class="profil-hero">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-inner">
            <span class="hero-eyebrow">✦ Profil Sekolah</span>
            <h1 class="hero-title">Tentang Kami</h1>
            <p class="hero-subtitle">"Membangun Generasi Cerdas dan Berkarakter"</p>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="profil-main">
        
        {{-- MENU CARDS --}}
        <div class="section-header-center">
            <h2>Pilih Menu Profil</h2>
            <div class="content-divider"></div>
        </div>

        <div class="menu-grid">
            @foreach($profils as $index => $profil)
            <a href="{{ route('profil.menu', $profil->nama_menu) }}" class="menu-card">
                <div class="menu-icon-wrap">
                    <span class="icon-emoji">
                        @switch($profil->nama_menu)
                            @case('sambutan')
                                👨‍🏫
                                @break
                            @case('visi-misi')
                                🎯
                                @break
                            @case('struktur-organisasi')
                                🏛️
                                @break
                            @case('sejarah')
                                📜
                                @break
                            @default
                                📋
                        @endswitch
                    </span>
                </div>
                <h3 class="menu-card-title">{{ $profil->judul }}</h3>
                <p class="menu-card-desc">Klik untuk melihat detail {{ strtolower($profil->judul) }}</p>
                <div class="menu-arrow">
                    <span>→</span>
                </div>
            </a>
            @endforeach
        </div>

        {{-- BACK BUTTON --}}
        <div class="back-section">
            <a href="/" class="btn-back">
                ← Kembali ke Halaman Utama
            </a>
        </div>

    </div>

</div>

@endsection

