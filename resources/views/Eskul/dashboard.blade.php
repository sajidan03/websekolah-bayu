@extends('layouts.app')
@section('title', 'Ekstrakurikuler')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --ink: #0d1b2a; --ink-mid: #1c3144;
    --accent: #e8a87c; --accent-dark: #c4834a;
    --white: #ffffff; --off-white: #f5f3ef; --light-bg: #fafaf8;
    --text-body: #4a5568; --text-muted: #718096; --border: #e2e8f0;
    --shadow-sm: 0 2px 8px rgba(13,27,42,0.06);
    --shadow-md: 0 8px 30px rgba(13,27,42,0.10);
    --shadow-lg: 0 20px 60px rgba(13,27,42,0.14);
    --radius: 16px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.eskul-wrapper { font-family: 'DM Sans', sans-serif; background: var(--light-bg); min-height: 100vh; color: var(--text-body); }

.eskul-hero { position: relative; background: var(--ink); padding: 100px 24px 90px; text-align: center; overflow: hidden; }
.hero-bg-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(232,168,124,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(232,168,124,0.04) 1px, transparent 1px); background-size: 60px 60px; pointer-events: none; }
.hero-orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
.hero-orb-1 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(232,168,124,0.15) 0%, transparent 70%); top: -100px; left: -80px; }
.hero-orb-2 { width: 320px; height: 320px; background: radial-gradient(circle, rgba(46,74,99,0.5) 0%, transparent 70%); bottom: -60px; right: -40px; }
.hero-inner { position: relative; z-index: 2; max-width: 640px; margin: 0 auto; animation: fadeUp 0.9s ease both; }
.hero-eyebrow { display: inline-block; font-size: 0.72rem; font-weight: 600; letter-spacing: 2.5px; text-transform: uppercase; color: var(--accent); border: 1px solid rgba(232,168,124,0.3); padding: 6px 18px; border-radius: 100px; margin-bottom: 24px; background: rgba(232,168,124,0.08); }
.eskul-hero h1 { font-family: 'Playfair Display', Georgia, serif; font-size: clamp(2.4rem, 5vw, 3.6rem); font-weight: 700; color: var(--white); line-height: 1.15; letter-spacing: -0.5px; margin-bottom: 16px; }
.eskul-hero h1 span { color: var(--accent); }
.eskul-hero p { color: rgba(255,255,255,0.7); font-size: 1rem; line-height: 1.75; font-weight: 300; }

.eskul-content { padding: 80px 24px 100px; max-width: 1160px; margin: 0 auto; }
.section-header { text-align: center; margin-bottom: 56px; }
.section-eyebrow { display: inline-block; font-size: 0.72rem; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: var(--accent-dark); background: rgba(232,168,124,0.12); border: 1px solid rgba(232,168,124,0.3); padding: 6px 16px; border-radius: 100px; margin-bottom: 16px; }
.section-title { font-family: 'Playfair Display', Georgia, serif; font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 700; color: var(--ink); margin-bottom: 12px; letter-spacing: -0.3px; }
.section-subtitle { color: var(--text-muted); font-size: 1rem; max-width: 480px; margin: 0 auto; line-height: 1.7; }
.content-divider { width: 48px; height: 3px; background: var(--accent); border-radius: 3px; margin: 20px auto 0; }

/* GRID — max 4 kolom */
.eskul-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
}

.eskul-card { background: var(--white); border-radius: var(--radius); overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: all 0.3s ease; position: relative; }
.eskul-card::after { content: ''; position: absolute; inset: 0 0 auto 0; height: 3px; background: linear-gradient(90deg, var(--accent-dark), var(--accent)); opacity: 0; transition: opacity 0.3s ease; }
.eskul-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: rgba(232,168,124,0.3); }
.eskul-card:hover::after { opacity: 1; }

.card-image { position: relative; height: 180px; background: var(--ink); display: flex; align-items: center; justify-content: center; overflow: hidden; }
.card-image::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(232,168,124,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(232,168,124,0.05) 1px, transparent 1px); background-size: 30px 30px; }
.card-image img { width: 90px; height: 90px; object-fit: cover; border-radius: 50%; border: 3px solid rgba(255,255,255,0.15); box-shadow: 0 8px 28px rgba(0,0,0,0.3); position: relative; z-index: 2; }
.card-icon { font-size: 54px; position: relative; z-index: 2; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.2)); }

.card-body { padding: 28px 24px; flex: 1; display: flex; flex-direction: column; text-align: center; }
.card-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.15rem; font-weight: 700; color: var(--ink); margin-bottom: 10px; line-height: 1.3; }
.card-pembina { display: inline-block; background: rgba(232,168,124,0.12); color: var(--accent-dark); border: 1px solid rgba(232,168,124,0.25); padding: 4px 14px; border-radius: 100px; font-size: 0.75rem; font-weight: 600; margin-bottom: 14px; }
.card-text { font-size: 0.9rem; color: var(--text-muted); line-height: 1.7; flex: 1; }
.card-badge { display: inline-block; background: var(--ink); color: var(--white); padding: 6px 18px; border-radius: 100px; font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 20px; align-self: center; transition: background 0.2s ease; }
.eskul-card:hover .card-badge { background: var(--accent-dark); }

.empty-state { grid-column: 1/-1; text-align: center; padding: 80px 40px; background: var(--white); border-radius: var(--radius); border: 1.5px dashed var(--border); }
.empty-icon { font-size: 64px; opacity: 0.35; margin-bottom: 20px; }
.empty-title { font-family: 'Playfair Display', Georgia, serif; font-size: 1.5rem; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
.empty-text { color: var(--text-muted); font-size: 0.95rem; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: translateY(0); } }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .eskul-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .eskul-hero { padding: 72px 20px 64px; }
    .eskul-content { padding: 52px 16px 72px; }
    /* TETAP 2 KOLOM di mobile */
    .eskul-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 14px; }
    .card-image { height: 140px; }
    .card-image img { width: 70px; height: 70px; }
    .card-icon { font-size: 40px; }
    .card-body { padding: 18px 14px; }
    .card-title { font-size: 0.95rem; }
    .card-text { font-size: 0.82rem; }
    .card-badge { font-size: 0.62rem; padding: 5px 14px; margin-top: 14px; }
}
@media (max-width: 480px) {
    /* TETAP 2 KOLOM di HP kecil */
    .eskul-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .card-image { height: 110px; }
    .card-body { padding: 14px 10px; }
    .card-title { font-size: 0.85rem; }
    .card-text { font-size: 0.76rem; }
    .card-pembina { font-size: 0.68rem; padding: 3px 10px; }
}
</style>

<div class="eskul-wrapper">

    <section class="eskul-hero">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-inner">
            <span class="hero-eyebrow">✦ Pengembangan Diri</span>
            <h1>Ekstra<span>kurikuler</span></h1>
            <p>Berbagai pilihan kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa secara optimal.</p>
        </div>
    </section>

    <section class="eskul-content">
        <div class="section-header">
            <span class="section-eyebrow">Daftar Program</span>
            <h2 class="section-title">Program Ekstrakurikuler</h2>
            <p class="section-subtitle">Pilih kegiatan yang sesuai dengan minat dan bakat Anda</p>
            <div class="content-divider"></div>
        </div>

        <div class="eskul-grid">
            @forelse($eskuls as $item)
                <div class="eskul-card">
                    <div class="card-image">
                        @if($item->gambar)
                            <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_eskul }}">
                        @else
                            <span class="card-icon">🎯</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_eskul }}</h5>
                        @if($item->pembina)
                            <span class="card-pembina">Pembina: {{ $item->pembina }}</span>
                        @endif
                        <p class="card-text">{{ $item->deskripsi }}</p>
                        <span class="card-badge">Aktif</span>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🎯</div>
                    <h4 class="empty-title">Belum Ada Data</h4>
                    <p class="empty-text">Data ekstrakurikuler akan segera ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>

@endsection