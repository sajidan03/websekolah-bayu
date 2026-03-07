@extends('layouts.app')
@section('title', 'Struktur Organisasi')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --gold: #C9A96E;
    --gold-light: #E8D5B0;
    --gold-dark: #9A7340;
    --navy: #0D1B2A;
    --navy-mid: #1A2E45;
    --navy-light: #243B55;
    --cream: #FAF7F2;
    --white: #FFFFFF;
    --text-muted: #8A9BB0;
  }

  .struktur-wrapper {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding: 0;
    overflow: hidden;
  }

  /* ── HERO SECTION ── */
  .struktur-hero {
    background: var(--navy);
    position: relative;
    padding: 90px 40px 80px;
    text-align: center;
    overflow: hidden;
  }

  .struktur-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 70% at 20% 50%, rgba(201,169,110,0.12) 0%, transparent 70%),
      radial-gradient(ellipse 50% 60% at 80% 50%, rgba(201,169,110,0.08) 0%, transparent 70%);
  }

  .struktur-hero::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 60px;
    background: var(--cream);
    clip-path: ellipse(55% 100% at 50% 100%);
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(201,169,110,0.15);
    border: 1px solid rgba(201,169,110,0.35);
    color: var(--gold);
    padding: 7px 22px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 26px;
    position: relative;
  }

  .hero-badge::before, .hero-badge::after {
    content: '✦';
    font-size: 9px;
  }

  .struktur-hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.8rem, 6vw, 4.5rem);
    font-weight: 700;
    color: var(--white);
    margin: 0 0 18px;
    line-height: 1.1;
    position: relative;
  }

  .struktur-hero h1 span {
    color: var(--gold);
  }

  .struktur-hero p {
    color: var(--text-muted);
    font-size: 15px;
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.7;
    position: relative;
  }

  .hero-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    margin: 28px auto 0;
    position: relative;
  }

  .hero-divider span {
    width: 60px;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--gold));
  }

  .hero-divider span:last-child {
    background: linear-gradient(90deg, var(--gold), transparent);
  }

  .hero-divider i {
    color: var(--gold);
    font-size: 10px;
  }

  /* ── STATS BAR ── */
  .stats-bar {
    background: var(--white);
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0;
    border-bottom: 1px solid #EDE8E0;
    box-shadow: 0 4px 30px rgba(13,27,42,0.06);
    position: relative;
    z-index: 2;
  }

  .stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 28px 48px;
    border-right: 1px solid #EDE8E0;
    min-width: 150px;
    animation: fadeInUp 0.6s ease both;
  }

  .stat-item:last-child { border-right: none; }

  .stat-number {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.6rem;
    font-weight: 700;
    color: var(--navy);
    line-height: 1;
  }

  .stat-number sup {
    font-size: 1.2rem;
    color: var(--gold);
  }

  .stat-label {
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-top: 5px;
    font-weight: 500;
  }

  /* ── ORG TREE SECTION ── */
  .struktur-section {
    padding: 70px 40px 80px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .section-header {
    text-align: center;
    margin-bottom: 52px;
  }

  .section-kicker {
    font-size: 11px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 500;
    margin-bottom: 12px;
  }

  .section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.4rem;
    font-weight: 700;
    color: var(--navy);
    margin: 0 0 12px;
  }

  .section-line {
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, var(--gold-dark), var(--gold));
    margin: 0 auto;
    border-radius: 2px;
  }

  /* ── ORG TREE ── */
  .org-tree {
    position: relative;
    padding: 30px 20px;
  }

  /* Level 1 - Kepala/Pimpinan */
  .level-1 {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
  }

  .level-1::after {
    content: '';
    position: absolute;
    bottom: -30px;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 30px;
    background: var(--gold);
  }

  /* Level 2 - Wakil/Manajer */
  .level-2 {
    display: flex;
    justify-content: center;
    gap: 80px;
    margin-bottom: 60px;
    position: relative;
    flex-wrap: wrap;
  }

  .level-2::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 2px;
    background: var(--gold);
  }

  .level-2 .org-item {
    position: relative;
  }

  .level-2 .org-item::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 30px;
    background: var(--gold);
  }

  /* Level 3 - Staff */
  .level-3 {
    display: grid;
    grid-template-columns: repeat(4, auto);
    justify-content: center;
    gap: 24px;
    position: relative;
    margin-top: 40px;
  }

  .level-3::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 2px;
    background: var(--gold);
  }

  .level-3 .org-item {
    position: relative;
  }

  .level-3 .org-item::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 30px;
    background: var(--gold);
  }

  /* Card Style */
  .card-org {
    background: var(--white);
    border: 1px solid #e0e0e0;
    padding: 20px 15px;
    width: 200px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin: 0 auto;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
  }

  .card-org:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(201,169,110,0.2);
    border-color: var(--gold);
  }

  .card-org.main {
    width: 220px;
    border: 2px solid var(--navy);
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
  }

  .card-org.small {
    width: 180px;
    padding: 15px 12px;
  }

  .card-org img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 12px;
    border: 3px solid var(--gold);
    padding: 3px;
    background: var(--cream);
  }

  .card-org.main img {
    width: 100px;
    height: 100px;
  }

  .card-org.small img {
    width: 70px;
    height: 70px;
  }

  .card-org h4 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    font-weight: 700;
    margin: 10px 0 5px 0;
    color: var(--navy);
  }

  .card-org.main h4 {
    font-size: 18px;
  }

  .card-org.small h4 {
    font-size: 14px;
  }

  .card-org p {
    font-size: 13px;
    color: #666;
    margin: 5px 0 0 0;
    font-style: italic;
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
  }

  .empty-state p {
    font-size: 16px;
  }

  /* ── ANIMATIONS ── */
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .org-item {
    animation: fadeInUp 0.6s ease forwards;
  }

  .level-1 { animation-delay: 0.1s; }
  .level-2 .org-item:nth-child(1) { animation-delay: 0.3s; }
  .level-2 .org-item:nth-child(2) { animation-delay: 0.4s; }
  .level-3 .org-item { animation-delay: 0.6s; }

  /* ── RESPONSIVE ── */
  @media (max-width: 992px) {
    .level-1::after,
    .level-2::before,
    .level-2 .org-item::before,
    .level-3::before,
    .level-3 .org-item::before {
        display: none;
    }

    .level-2 {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 16px;
        justify-content: center;
    }

    .level-3 {
        grid-template-columns: repeat(3, auto);
        gap: 16px;
    }

    .card-org,
    .card-org.main,
    .card-org.small {
        width: 170px;
    }
  }

  @media (max-width: 768px) {
    .level-3 {
        grid-template-columns: repeat(2, auto);
        gap: 14px;
    }
    .struktur-section { padding: 44px 16px 56px; }
    .struktur-hero { padding: 64px 20px 56px; }
    .stats-bar { flex-wrap: wrap; }
    .stat-item { flex: 1 1 40%; border-right: none; border-bottom: 1px solid #EDE8E0; padding: 18px 16px; }
  }

  @media (max-width: 580px) {
    .level-2 {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
    }

    .level-3 {
        grid-template-columns: repeat(2, auto);
        gap: 10px;
    }

    .card-org,
    .card-org.main,
    .card-org.small {
        width: 140px;
        padding: 14px 10px;
    }

    .card-org img, .card-org.main img { width: 64px; height: 64px; }
    .card-org.small img { width: 56px; height: 56px; }
    .card-org h4 { font-size: 12px; }
    .card-org p { font-size: 11px; }
    .section-title { font-size: 1.6rem; }
  }
</style>

<div class="struktur-wrapper">

  {{-- HERO --}}
  <div class="struktur-hero">
    <div class="hero-badge">Struktur Organisasi</div>
    <h1>Organisasi <span>Sekolah</span></h1>
    <p>Berikut adalah struktur organisasi sekolah kami yang terdiri dari pimpinan, dewan guru, dan staff pendukung.</p>
    <div class="hero-divider">
      <span></span>
      <i>✦</i>
      <span></span>
    </div>
  </div>

  {{-- STATS BAR --}}
  <div class="stats-bar">
    <div class="stat-item" style="animation-delay:0.1s">
      <div class="stat-number">{{ isset($profils) ? $profils->count() : 0 }}<sup>+</sup></div>
      <div class="stat-label">Total Personel</div>
    </div>
  </div>

  {{-- ORG TREE --}}
  <div class="struktur-section">
    <div class="section-header">
      <div class="section-kicker">Hierarki Organisasi</div>
      <h2 class="section-title">Bagan Struktur</h2>
      <div class="section-line"></div>
    </div>

    <div class="org-tree">
      
      {{-- LEVEL 1: KEPALA / PIMPINAN --}}
      @forelse($profils as $item)
        @if($loop->first)
          <div class="level level-1">
            <div class="card-org main">
              @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
              @else
                <img src="https://via.placeholder.com/100" alt="Foto">
              @endif
              <h4>{!! nl2br(e($item->judul)) !!}</h4>
              @if($item->konten)
                <p>{!! nl2br(e($item->konten)) !!}</p>
              @endif
            </div>
          </div>
        @endif
      @endforeach

      {{-- LEVEL 2: WAKIL / MANAJER --}}
      <div class="level level-2">
        @foreach($profils as $item)
          @if($loop->iteration == 2 || $loop->iteration == 3)
            <div class="org-item">
              <div class="card-org main">
                @if($item->gambar)
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                @else
                  <img src="https://via.placeholder.com/100" alt="Foto">
                @endif
                <h4>{!! nl2br(e($item->judul)) !!}</h4>
                @if($item->konten)
                  <p>{!! nl2br(e($item->konten)) !!}</p>
                @endif
              </div>
            </div>
          @endif
        @endforeach
      </div>

      {{-- LEVEL 3: STAFF --}}
      <div class="level level-3">
        @foreach($profils as $item)
          @if($loop->iteration > 3)
            <div class="org-item">
              <div class="card-org main">
                @if($item->gambar)
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                @else
                  <img src="https://via.placeholder.com/100" alt="Foto">
                @endif
                <h4>{!! nl2br(e($item->judul)) !!}</h4>
                @if($item->konten)
                  <p>{!! nl2br(e($item->konten)) !!}</p>
                @endif
              </div>
            </div>
          @endif
        @endforeach
      </div>

      @if(!isset($profils) || $profils->isEmpty())
        <div class="empty-state">
          <p>Belum ada data struktur organisasi.</p>
        </div>
      @endif

    </div>
  </div>
</div>
@endsection

