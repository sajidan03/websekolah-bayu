@extends('layouts.app')
@section('title', 'Sambutan Kepala Sekolah')
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --ink:        #0d1b2a;
    --ink-mid:    #1c3144;
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

.sambutan-wrapper {
    font-family: 'DM Sans', sans-serif;
    background: var(--light-bg);
    min-height: 100vh;
    color: var(--text-body);
}

/* ===== HERO HEADER ===== */
.sambutan-hero {
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
.sambutan-main {
    max-width: 1100px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}

.sambutan-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 40px;
    align-items: start;
}

/* ===== PROFILE CARD ===== */
.profile-card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    position: sticky;
    top: 24px;
}

.profile-img-wrap {
    width: 100%;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: var(--ink);
}

.profile-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.profile-card:hover .profile-img-wrap img {
    transform: scale(1.04);
}

.profile-info {
    padding: 24px 20px;
    text-align: center;
    border-top: 1px solid var(--border);
}

.profile-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
}

.profile-role {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--accent-dark);
    background: rgba(232,168,124,0.12);
    border: 1px solid rgba(232,168,124,0.25);
    padding: 4px 14px;
    border-radius: 100px;
    margin-bottom: 16px;
}

.profile-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.82rem;
    color: var(--text-muted);
    margin-bottom: 6px;
    flex-wrap: wrap;
}

/* ===== SAMBUTAN CONTENT ===== */
.sambutan-content {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-md);
    padding: 40px 44px;
    max-width: 100%;
    overflow: hidden;
}

.salam-text {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--ink);
    padding-bottom: 16px;
    margin-bottom: 24px;
    border-bottom: 1px dashed var(--border);
}

.konten-text {
    font-size: 0.98rem;
    line-height: 1.85;
    color: var(--text-body);
    text-align: justify;
    max-width: 100%;
    word-break: break-word;
    overflow-wrap: anywhere;
}

.konten-text p {
    margin-bottom: 1rem;
}

/* ===== PENUTUP & TTD ===== */
.penutup-section {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px 80px;
}

.penutup-card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-sm);
    padding: 36px 44px;
}

.penutup-text {
    font-size: 0.98rem;
    line-height: 1.85;
    color: var(--text-body);
    margin-bottom: 1rem;
}

.wassalam-text {
    font-size: 1rem;
    font-weight: 600;
    color: var(--ink);
    margin-bottom: 32px;
}

.ttd-box {
    display: inline-block;
    background: var(--off-white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px 32px;
    box-shadow: var(--shadow-sm);
}

.ttd-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
}

.ttd-role {
    font-size: 0.82rem;
    color: var(--text-muted);
    font-weight: 500;
}

/* ===== FOOTER ===== */
.sambutan-footer {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px 48px;
    border-top: 1px solid var(--border);
    padding-top: 24px;
    text-align: center;
}

.footer-text {
    font-size: 0.8rem;
    color: var(--text-muted);
    letter-spacing: 0.3px;
}

/* ===== ANIMATION ===== */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== MOBILE CARD COMPACT ===== */
.mobile-profile-card {
    display: none;
}

.mobile-profile-card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin-bottom: 24px;
}

.mobile-profile-top {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
}

.mobile-profile-img {
    width: 90px;
    height: 110px;
    object-fit: cover;
    border-radius: 10px;
    flex-shrink: 0;
    border: 2px solid var(--border);
}

.mobile-profile-meta {
    flex: 1;
}

.mobile-profile-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
}

.mobile-profile-role {
    display: inline-block;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--accent-dark);
    background: rgba(232,168,124,0.12);
    border: 1px solid rgba(232,168,124,0.25);
    padding: 3px 10px;
    border-radius: 100px;
    margin-bottom: 10px;
}

.mobile-read-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--ink);
    color: var(--white);
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}

.mobile-read-btn:hover { background: var(--ink-mid); }

.mobile-read-btn svg {
    transition: transform 0.3s;
}

.mobile-read-btn.open svg {
    transform: rotate(180deg);
}

.mobile-content-collapse {
    display: none;
    padding: 0 20px 20px;
    border-top: 1px dashed var(--border);
    padding-top: 16px;
}

.mobile-content-collapse.show {
    display: block;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .sambutan-grid {
        grid-template-columns: 1fr;
    }

    /* Sembunyikan profile card desktop di mobile */
    .sambutan-grid > aside {
        display: none;
    }

    /* Tampilkan mobile card */
    .mobile-profile-card {
        display: block;
    }

    .sambutan-content {
        padding: 28px 24px;
    }

    .penutup-card {
        padding: 28px 24px;
    }

    .hero-title {
        font-size: 1.8rem;
    }
}

@media (max-width: 480px) {
    .sambutan-hero { padding: 60px 20px 56px; }
    .sambutan-main { padding: 40px 16px 60px; }
    .penutup-section { padding: 0 16px 60px; }
}
</style>

<div class="sambutan-wrapper">

    {{-- HERO --}}
    <section class="sambutan-hero">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-inner">
            <span class="hero-eyebrow">✦ Profil Sekolah</span>
            <h1 class="hero-title">{{ optional($profil)->judul ?? 'Sambutan Kepala Sekolah' }}</h1>
            <p class="hero-subtitle">"Membangun Generasi Cerdas dan Berkarakter"</p>
        </div>
    </section>

    {{-- MOBILE PROFILE CARD (hanya muncul di HP) --}}
    <div class="sambutan-main" style="padding-bottom:0;">
        <div class="mobile-profile-card">
            <div class="mobile-profile-top">
                <img class="mobile-profile-img"
                     src="{{ asset('assets/' . (optional($profil)->gambar ?? 'udin.png')) }}"
                     alt="Kepala Sekolah">
                <div class="mobile-profile-meta">
                    <div class="mobile-profile-name">{{ optional($profil)->nama_kepala_sekolah ?? 'Drs. Budi Santoso' }}</div>
                    <div class="mobile-profile-role">Kepala Sekolah</div>
                    <button class="mobile-read-btn" id="mobileReadBtn" onclick="toggleMobileContent()">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mobile-content-collapse" id="mobileContent">
                <p class="salam-text" style="margin-bottom:12px;">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                <div class="konten-text">
                    @if(optional($profil)->konten)
                        {!! nl2br(e($profil->konten)) !!}
                    @else
                        <p>Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa.</p>
                        <p>Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai media informasi dan komunikasi antara sekolah, siswa, orang tua, dan masyarakat luas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="sambutan-main">
        <div class="sambutan-grid">

            {{-- PROFILE CARD --}}
            <aside>
                <div class="profile-card">
                    <div class="profile-img-wrap">
                        <img src="{{ asset('assets/' . (optional($profil)->gambar ?? 'udin.png')) }}"
                             alt="Kepala Sekolah">
                    </div>
                    <div class="profile-info">
                        <div class="profile-name">{{ optional($profil)->nama_kepala_sekolah ?? 'Drs. Budi Santoso' }}</div>
                        <div class="profile-role">Kepala Sekolah</div>
                    </div>
                </div>
            </aside>

            {{-- SAMBUTAN CONTENT --}}
            <div class="sambutan-content">
                <p class="salam-text">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                <div class="konten-text">
                    @if(optional($profil)->konten)
                        {!! nl2br(e($profil->konten)) !!}
                    @else
                        <p>Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa, karena atas rahmat dan karunia-Nya, kita semua masih diberikan kesehatan dan kesempatan untuk terus berkarya dalam dunia pendidikan.</p>
                        <p>Selamat datang di website resmi sekolah kami. Website ini kami hadirkan sebagai media informasi dan komunikasi antara sekolah, siswa, orang tua, dan masyarakat luas.</p>
                        <p>Kami berharap dengan adanya website ini, informasi mengenai kegiatan dan perkembangan sekolah dapat diakses dengan mudah dan transparan. Kami berkomitmen untuk terus meningkatkan kualitas pendidikan dan pelayanan kepada siswa.</p>
                        <p>Dengan dukungan tenaga pendidik yang kompeten dan fasilitas yang memadai, kami optimis dapat mencetak generasi yang cerdas, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>


    {{-- FOOTER --}}
    <div class="sambutan-footer">
        <p class="footer-text">{{ config('app.school_name', 'SMK SLB') }} &bull; Website Resmi Sekolah</p>
    </div>

</div>

@endsection

@push('scripts')
<script>
function toggleMobileContent() {
    const content = document.getElementById('mobileContent');
    const btn = document.getElementById('mobileReadBtn');
    content.classList.toggle('show');
    btn.classList.toggle('open');
    btn.childNodes[0].textContent = content.classList.contains('show') ? 'Sembunyikan ' : 'Baca Selengkapnya ';
}
</script>
@endpush