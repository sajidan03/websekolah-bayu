@extends('layouts.app')
@section('title', 'Prestasi Sekolah')

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

.prestasi-wrapper {
    font-family: 'DM Sans', sans-serif;
    background: var(--light-bg);
    min-height: 100vh;
    color: var(--text-body);
}

/* ===== HERO ===== */
.prestasi-hero {
    position: relative;
    background: var(--ink);
    padding: 100px 24px 90px;
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
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(232,168,124,0.15) 0%, transparent 70%);
    top: -100px; left: -80px;
}
.hero-orb-2 {
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(46,74,99,0.5) 0%, transparent 70%);
    bottom: -60px; right: -40px;
}

.hero-inner {
    position: relative;
    z-index: 2;
    max-width: 640px;
    margin: 0 auto;
    animation: fadeUp 0.9s ease both;
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
    margin-bottom: 24px;
    background: rgba(232,168,124,0.08);
}

.prestasi-hero h1 {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2.2rem, 5vw, 3.4rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.15;
    letter-spacing: -0.5px;
    margin-bottom: 16px;
}

.prestasi-hero h1 span { color: var(--accent); }

.prestasi-hero p {
    color: rgba(255,255,255,0.7);
    font-size: 1rem;
    line-height: 1.75;
    font-weight: 300;
}

/* ===== STATS ===== */
.stats-section {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 0;
}

.stats-inner {
    display: flex;
    justify-content: center;
    divide: var(--border);
}

.stat-item {
    flex: 1;
    text-align: center;
    padding: 36px 20px;
    border-right: 1px solid var(--border);
    transition: background 0.2s ease;
}
.stat-item:last-child { border-right: none; }
.stat-item:hover { background: var(--off-white); }

.stat-number {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 2.4rem;
    font-weight: 700;
    color: var(--ink);
    line-height: 1;
    margin-bottom: 6px;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-weight: 500;
}

/* ===== CONTENT ===== */
.prestasi-content {
    padding: 80px 24px 100px;
    max-width: 1160px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 56px;
}

.section-eyebrow {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--accent-dark);
    background: rgba(232,168,124,0.12);
    border: 1px solid rgba(232,168,124,0.3);
    padding: 6px 16px;
    border-radius: 100px;
    margin-bottom: 16px;
}

.section-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(1.8rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 12px;
    letter-spacing: -0.3px;
}

.section-subtitle {
    color: var(--text-muted);
    font-size: 1rem;
    max-width: 480px;
    margin: 0 auto;
    line-height: 1.7;
}

.content-divider {
    width: 48px;
    height: 3px;
    background: var(--accent);
    border-radius: 3px;
    margin: 20px auto 0;
}

/* ===== CARDS GRID ===== */
.cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.prestasi-card {
    background: var(--white);
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    position: relative;
}

.prestasi-card::after {
    content: '';
    position: absolute;
    inset: 0 0 auto 0;
    height: 3px;
    background: linear-gradient(90deg, var(--accent-dark), var(--accent));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.prestasi-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: rgba(232,168,124,0.3);
}

.prestasi-card:hover::after { opacity: 1; }

/* Card Image */
.card-image {
    height: 180px;
    background: var(--ink);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.card-image::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(232,168,124,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(232,168,124,0.05) 1px, transparent 1px);
    background-size: 30px 30px;
}

.card-image img {
    width: 84px; height: 84px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.15);
    box-shadow: 0 8px 28px rgba(0,0,0,0.3);
    position: relative;
    z-index: 2;
}

.card-icon {
    font-size: 52px;
    position: relative;
    z-index: 2;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.2));
}

/* Card Body */
.card-body {
    padding: 22px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-category {
    display: inline-block;
    background: rgba(232,168,124,0.12);
    color: var(--accent-dark);
    border: 1px solid rgba(232,168,124,0.25);
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 12px;
    width: fit-content;
}

.card-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 10px;
    line-height: 1.4;
}

.card-text {
    font-size: 0.88rem;
    color: var(--text-muted);
    line-height: 1.65;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 16px;
}

.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    margin-top: auto;
}

.card-date {
    font-size: 0.78rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 5px;
}

.card-badge {
    background: var(--ink);
    color: var(--white);
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 40px;
    background: var(--white);
    border-radius: var(--radius);
    border: 1.5px dashed var(--border);
}

.empty-icon { font-size: 64px; opacity: 0.35; margin-bottom: 20px; }
.empty-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}
.empty-text { color: var(--text-muted); font-size: 0.95rem; }

/* ===== ANIMATION ===== */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
    .cards-grid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 1024px) {
    .cards-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
    .prestasi-hero { padding: 72px 20px 64px; }
    .prestasi-content { padding: 52px 16px 72px; }
    .cards-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 14px; }
    .stats-inner { flex-wrap: wrap; }
    .stat-item { flex: 1 1 calc(33% - 1px); }
    .card-image { height: 140px; }
    .card-image img { width: 64px; height: 64px; }
    .card-icon { font-size: 38px; }
    .card-body { padding: 16px 14px; }
    .card-title { font-size: 0.88rem; }
    .card-text { font-size: 0.8rem; -webkit-line-clamp: 2; }
}
@media (max-width: 480px) {
    .cards-grid { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .stats-inner { flex-direction: row; flex-wrap: wrap; }
    .stat-item { flex: 1 1 calc(33% - 1px); border-right: 1px solid var(--border); border-bottom: none; padding: 20px 10px; }
    .stat-number { font-size: 1.6rem; }
    .card-image { height: 110px; }
    .card-body { padding: 12px 10px; }
    .card-title { font-size: 0.82rem; }
    .card-text { font-size: 0.75rem; }
    .card-date { font-size: 0.68rem; }
}
</style>

<div class="prestasi-wrapper">

    {{-- Hero --}}
    <section class="prestasi-hero">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-inner">
            <span class="hero-eyebrow">✦ Achievements</span>
            <h1>Prestasi <span>Sekolah</span></h1>
            <p>Kumpulan prestasi membanggakan yang telah diraih oleh siswa-siswi kami di berbagai bidang kompetisi</p>
        </div>
    </section>

    {{-- Stats --}}
    <section class="stats-section">
        <div class="stats-inner">
            <div class="stat-item">
                <div class="stat-number">{{ $prestasis->count() }}</div>
                <div class="stat-label">Total Prestasi</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    @php
                        $akademik = $prestasis->filter(fn($item) => $item->kategori == 'Akademik')->count();
                        $nonAkademik = $prestasis->count() - $akademik;
                    @endphp
                    {{ $akademik }}
                </div>
                <div class="stat-label">Akademik</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $nonAkademik }}</div>
                <div class="stat-label">Non-Akademik</div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="prestasi-content">
        <div class="section-header">
            <span class="section-eyebrow">Daftar Lengkap</span>
            <h2 class="section-title">Prestasi & Penghargaan</h2>
            <p class="section-subtitle">Berikut adalah prestasi yang telah berhasil diraih oleh siswa-siswi kami</p>
            <div class="content-divider"></div>
        </div>

        <div class="cards-grid">
            @forelse($prestasis as $index => $item)
                @php
                    $icons = ['🏆', '🥇', '🥈', '🥉', '📚', '🎨', '⚽', '🎭'];
                @endphp
                <div class="prestasi-card">
                    <div class="card-image">
                        @if($item->foto)
                            <img src="{{ asset('assets/' . $item->foto) }}" alt="{{ $item->nama_prestasi }}">
                        @else
                            <span class="card-icon">{{ $icons[$index % count($icons)] }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <span class="card-category">{{ $item->kategori ?? 'Non-Akademik' }}</span>
                        <h5 class="card-title">{{ $item->nama_prestasi }}</h5>
                        <p class="card-text">{{ Str::limit($item->isi, 100) }}</p>
                        <div class="card-footer">
                            <span class="card-date">📅 {{ now()->format('d M Y') }}</span>
                            <span class="card-badge">Prestasi</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">🏆</div>
                    <h4 class="empty-title">Belum Ada Prestasi</h4>
                    <p class="empty-text">Data prestasi akan segera ditambahkan</p>
                </div>
            @endforelse
        </div>
    </section>

</div>

@endsection