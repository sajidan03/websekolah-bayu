@extends('layouts.app')
@section('title','Fasilitas Sekolah')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --gold: #C9A96E; --gold-light: #E8D5B0; --gold-dark: #9A7340;
    --navy: #0D1B2A; --navy-mid: #1A2E45; --navy-light: #243B55;
    --cream: #FAF7F2; --white: #FFFFFF; --text-muted: #8A9BB0;
  }

  .fasilitas-wrapper { font-family: 'DM Sans', sans-serif; background: var(--cream); min-height: 100vh; padding: 0; overflow: hidden; }

  .fasilitas-hero { background: var(--navy); position: relative; padding: 90px 40px 80px; text-align: center; overflow: hidden; }
  .fasilitas-hero::before { content: ''; position: absolute; inset: 0; background: radial-gradient(ellipse 60% 70% at 20% 50%, rgba(201,169,110,0.12) 0%, transparent 70%), radial-gradient(ellipse 50% 60% at 80% 50%, rgba(201,169,110,0.08) 0%, transparent 70%); }
  .fasilitas-hero::after { content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 60px; background: var(--cream); clip-path: ellipse(55% 100% at 50% 100%); }

  .hero-badge { display: inline-flex; align-items: center; gap: 10px; background: rgba(201,169,110,0.15); border: 1px solid rgba(201,169,110,0.35); color: var(--gold); padding: 7px 22px; border-radius: 50px; font-size: 11px; font-weight: 500; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 26px; position: relative; }
  .hero-badge::before, .hero-badge::after { content: '✦'; font-size: 9px; }

  .fasilitas-hero h1 { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.8rem, 6vw, 4.5rem); font-weight: 700; color: var(--white); margin: 0 0 18px; line-height: 1.1; position: relative; }
  .fasilitas-hero h1 span { color: var(--gold); }
  .fasilitas-hero p { color: var(--text-muted); font-size: 15px; max-width: 560px; margin: 0 auto; line-height: 1.7; position: relative; }

  .hero-divider { display: flex; align-items: center; justify-content: center; gap: 14px; margin: 28px auto 0; position: relative; }
  .hero-divider span { width: 60px; height: 1px; background: linear-gradient(90deg, transparent, var(--gold)); }
  .hero-divider span:last-child { background: linear-gradient(90deg, var(--gold), transparent); }
  .hero-divider i { color: var(--gold); font-size: 10px; }

  .stats-bar { background: var(--white); display: flex; justify-content: center; flex-wrap: wrap; border-bottom: 1px solid #EDE8E0; box-shadow: 0 4px 30px rgba(13,27,42,0.06); position: relative; z-index: 2; }
  .stat-item { display: flex; flex-direction: column; align-items: center; padding: 28px 48px; border-right: 1px solid #EDE8E0; min-width: 150px; }
  .stat-item:last-child { border-right: none; }
  .stat-number { font-family: 'Cormorant Garamond', serif; font-size: 2.6rem; font-weight: 700; color: var(--navy); line-height: 1; }
  .stat-number sup { font-size: 1.2rem; color: var(--gold); }
  .stat-label { font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--text-muted); margin-top: 5px; font-weight: 500; }

  .fasilitas-section { padding: 70px 40px 80px; max-width: 1200px; margin: 0 auto; }
  .section-header { text-align: center; margin-bottom: 52px; }
  .section-kicker { font-size: 11px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); font-weight: 500; margin-bottom: 12px; }
  .section-title { font-family: 'Cormorant Garamond', serif; font-size: 2.4rem; font-weight: 700; color: var(--navy); margin: 0 0 12px; }
  .section-line { width: 50px; height: 2px; background: linear-gradient(90deg, var(--gold-dark), var(--gold)); margin: 0 auto; border-radius: 2px; }

  /* GRID — max 4 kolom */
  .cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
  }

  .facility-card { background: var(--white); border-radius: 18px; overflow: hidden; border: 1px solid #EDE8E0; box-shadow: 0 4px 24px rgba(13,27,42,0.06); transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease; animation: fadeInUp 0.6s ease both; position: relative; display: flex; flex-direction: column; }
  .facility-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(13,27,42,0.14); }
  .facility-card:nth-child(1) { animation-delay: 0.05s; }
  .facility-card:nth-child(2) { animation-delay: 0.12s; }
  .facility-card:nth-child(3) { animation-delay: 0.19s; }
  .facility-card:nth-child(4) { animation-delay: 0.26s; }
  .facility-card:nth-child(5) { animation-delay: 0.33s; }
  .facility-card:nth-child(6) { animation-delay: 0.40s; }

  .card-accent { height: 4px; background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light)); }

  .card-body { padding: 30px 28px 26px; flex: 1; display: flex; flex-direction: column; }

  .card-icon-wrap { width: 100%; height: 180px; border-radius: 14px; background: var(--cream); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; position: relative; overflow: hidden; flex-shrink: 0; }
  .card-icon-wrap img { width: 100%; height: 100%; object-fit: cover; }

  .card-count { font-family: 'Cormorant Garamond', serif; font-size: 13px; font-weight: 600; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 6px; }
  .card-title { font-family: 'Cormorant Garamond', serif; font-size: 1.45rem; font-weight: 700; color: var(--navy); margin: 0 0 10px; line-height: 1.2; }
  .card-desc { font-size: 13.5px; color: #6B7A8D; line-height: 1.65; flex: 1; margin-bottom: 20px; }

  @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .cards-grid { grid-template-columns: repeat(3, 1fr); }
  }
  @media (max-width: 768px) {
    /* TETAP 2 KOLOM di mobile */
    .cards-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 16px; }
    .fasilitas-section { padding: 44px 16px 56px; }
    .fasilitas-hero { padding: 64px 20px 56px; }
    .stat-item { padding: 20px 24px; min-width: unset; }
    .card-body { padding: 20px 16px 18px; }
    .card-icon-wrap { height: 140px; }
    .card-title { font-size: 1.15rem; }
    .card-desc { font-size: 12.5px; }
  }
  @media (max-width: 480px) {
    /* TETAP 2 KOLOM di HP kecil */
    .cards-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .stats-bar { flex-wrap: wrap; }
    .stat-item { flex: 1 1 40%; border-right: none; border-bottom: 1px solid #EDE8E0; padding: 16px; }
    .card-body { padding: 14px 12px; }
    .card-icon-wrap { height: 110px; margin-bottom: 12px; }
    .card-title { font-size: 1rem; }
    .card-desc { font-size: 11.5px; margin-bottom: 0; }
    .card-count { font-size: 11px; }
  }
</style>

<div class="fasilitas-wrapper">

  <div class="fasilitas-hero">
    <div class="hero-badge">Lengkap & Modern</div>
    <h1>Fasilitas <span>Sekolah</span></h1>
    <p>Berikut adalah fasilitas yang tersedia di sekolah kami untuk mendukung proses pembelajaran dan kegiatan siswa secara optimal.</p>
    <div class="hero-divider"><span></span><i>✦</i><span></span></div>
  </div>

  <div class="stats-bar">
    <div class="stat-item">
      <div class="stat-number">{{ $fasilitas->count() }}<sup>+</sup></div>
      <div class="stat-label">Total Fasilitas</div>
    </div>
  </div>

  <div class="fasilitas-section">
    <div class="section-header">
      <div class="section-kicker">Fasilitas Unggulan</div>
      <h2 class="section-title">Sarana & Prasarana</h2>
      <div class="section-line"></div>
    </div>

    <div class="cards-grid">
      @forelse($fasilitas as $index => $item)
      <div class="facility-card">
        <div class="card-accent"></div>
        <div class="card-body">
          <div class="card-icon-wrap">
            @if($item->gambar)
              <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}">
            @endif
          </div>
          <div class="card-count">Fasilitas</div>
          <h3 class="card-title">{{ $item->nama_fasilitas }}</h3>
          <p class="card-desc">{{ $item->deskripsi }}</p>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:40px;">
        <p style="color:#6B7A8D;font-size:14px;">Belum ada data fasilitas.</p>
      </div>
      @endforelse
    </div>
  </div>
</div>
@endsection