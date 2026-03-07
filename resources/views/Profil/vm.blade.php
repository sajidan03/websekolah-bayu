@extends('layouts.app')
@section('title', 'Visi Misi')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

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

  .vm-wrapper {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    padding: 0;
    overflow: hidden;
  }

  .vm-hero {
    background: var(--navy);
    position: relative;
    padding: 90px 40px 80px;
    text-align: center;
    overflow: hidden;
  }

  .vm-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 70% at 20% 50%, rgba(201,169,110,0.12) 0%, transparent 70%),
      radial-gradient(ellipse 50% 60% at 80% 50%, rgba(201,169,110,0.08) 0%, transparent 70%);
  }

  .vm-hero::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 60px;
    background: var(--cream);
    clip-path: ellipse(55% 100% at 50% 100%);
  }

  .hero-badge {
    display: inline-flex; align-items: center; gap: 10px;
    background: rgba(201,169,110,0.15);
    border: 1px solid rgba(201,169,110,0.35);
    color: var(--gold);
    padding: 7px 22px; border-radius: 50px;
    font-size: 11px; font-weight: 500;
    letter-spacing: 3px; text-transform: uppercase;
    margin-bottom: 26px; position: relative;
  }
  .hero-badge::before, .hero-badge::after { content: '✦'; font-size: 9px; }

  .vm-hero h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.8rem, 6vw, 4.5rem);
    font-weight: 700; color: var(--white);
    margin: 0 0 18px; line-height: 1.1; position: relative;
  }
  .vm-hero h1 span { color: var(--gold); }

  .vm-hero p {
    color: var(--text-muted); font-size: 15px;
    max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative;
  }

  .hero-divider {
    display: flex; align-items: center; justify-content: center;
    gap: 14px; margin: 28px auto 0; position: relative;
  }
  .hero-divider span { width: 60px; height: 1px; background: linear-gradient(90deg, transparent, var(--gold)); }
  .hero-divider span:last-child { background: linear-gradient(90deg, var(--gold), transparent); }
  .hero-divider i { color: var(--gold); font-size: 10px; }

  .vm-section {
    padding: 70px 40px 80px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .content-card {
    background: var(--white); border-radius: 24px; padding: 50px;
    box-shadow: 0 10px 40px rgba(13,27,42,0.08);
    border: 1px solid rgba(201,169,110,0.2);
    position: relative; overflow: hidden;
    animation: fadeInUp 0.6s ease both;
  }
  .content-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 6px;
    background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
  }

  .empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); }
  .empty-state p { font-size: 16px; }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ── VM SPLIT LAYOUT ── */
  .vm-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  .vm-split-card {
    background: var(--white);
    border-radius: 20px;
    padding: 36px 30px;
    box-shadow: 0 10px 40px rgba(13,27,42,0.08);
    border: 1px solid rgba(201,169,110,0.2);
    position: relative; overflow: hidden;
    animation: fadeInUp 0.6s ease both;
  }

  .vm-split-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
  }
  .vm-split-card.visi::before { background: linear-gradient(90deg, var(--gold-dark), var(--gold)); }
  .vm-split-card.misi::before { background: linear-gradient(90deg, var(--navy-light), var(--navy-mid)); }

  .vm-split-icon {
    width: 52px; height: 52px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px;
  }
  .vm-split-card.visi .vm-split-icon {
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    box-shadow: 0 4px 15px rgba(201,169,110,0.3);
  }
  .vm-split-card.misi .vm-split-icon {
    background: linear-gradient(135deg, var(--navy-light), var(--navy));
    box-shadow: 0 4px 15px rgba(13,27,42,0.2);
  }
  .vm-split-icon svg { width: 24px; height: 24px; color: white; }

  .vm-split-label {
    font-size: 11px; letter-spacing: 2.5px;
    text-transform: uppercase; font-weight: 600; margin-bottom: 10px;
  }
  .vm-split-card.visi .vm-split-label { color: var(--gold-dark); }
  .vm-split-card.misi .vm-split-label { color: var(--navy-mid); }

  .vm-split-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.6rem; font-weight: 700;
    color: var(--navy); margin-bottom: 14px;
  }

  .vm-split-text {
    font-size: 14px; color: var(--text-muted);
    line-height: 1.8; white-space: pre-line;
  }

  /* ── RESPONSIVE: SELALU 2 KOLOM ── */
  @media (max-width: 640px) {
    .vm-split {
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .vm-split-card { padding: 20px 12px; }
    .vm-split-icon { width: 38px; height: 38px; margin-bottom: 10px; }
    .vm-split-icon svg { width: 16px; height: 16px; }
    .vm-split-label { font-size: 9px; letter-spacing: 1px; margin-bottom: 6px; }
    .vm-split-title { font-size: 1.1rem; margin-bottom: 8px; }
    .vm-split-text { font-size: 12px; line-height: 1.65; }
    .vm-section { padding: 36px 12px 56px; }
    .vm-hero { padding: 70px 20px 60px; }
  }

  @media (max-width: 380px) {
    .vm-split { gap: 8px; }
    .vm-split-card { padding: 16px 10px; }
    .vm-split-title { font-size: 1rem; }
    .vm-split-text { font-size: 11px; }
  }
</style>

<div class="vm-wrapper">

  {{-- HERO --}}
  <div class="vm-hero">
    <div class="hero-badge">Tentang Kami</div>
    <h1>Visi <span>&</span> Misi</h1>
    <p>Mengenal lebih jauh tentang tujuan dan arah pendidikan sekolah kami untuk menciptakan generasi yang berkarakter.</p>
    <div class="hero-divider">
      <span></span><i>✦</i><span></span>
    </div>
  </div>

  {{-- MAIN CONTENT --}}
  <div class="vm-section">

    @if($profil && ($profil->konten || $profil->isi_visi || $profil->isi_misi))

      @if($profil->isi_visi || $profil->isi_misi)
        <div class="vm-split">

          @if($profil->isi_visi)
          <div class="vm-split-card visi">
            <div class="vm-split-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
            </div>
            <div class="vm-split-label">Visi Kami</div>
            <div class="vm-split-title">Visi</div>
            <div class="vm-split-text">{!! nl2br(e($profil->isi_visi)) !!}</div>
          </div>
          @endif

          @if($profil->isi_misi)
          <div class="vm-split-card misi">
            <div class="vm-split-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <circle cx="12" cy="12" r="6"/>
                <circle cx="12" cy="12" r="2"/>
              </svg>
            </div>
            <div class="vm-split-label">Misi Kami</div>
            <div class="vm-split-title">Misi</div>
            <div class="vm-split-text">{!! nl2br(e($profil->isi_misi)) !!}</div>
          </div>
          @endif

        </div>

      @else
        <div class="content-card">
          <div class="content-body">{!! nl2br(e($profil->konten)) !!}</div>
        </div>
      @endif

    @else
      <div class="content-card">
        <div class="empty-state"><p>Belum ada data visi misi.</p></div>
      </div>
    @endif

  </div>
</div>

@endsection