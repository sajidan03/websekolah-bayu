@extends('layouts.app')

@section('title', 'Sejarah Sekolah')

@section('content')

@php
    $sejarah = isset($profil) ? $profil : null;
    $description = $sejarah?->description ?? '';
    $historyImages = $sejarah?->historyImages ?? [];
@endphp

<div class="sejarah-wrapper">

    {{-- Page Header --}}
    <div class="sejarah-hero">
        <div class="sejarah-hero-inner">
            <span class="sejarah-label">Profil Sekolah</span>
            <h1 class="sejarah-title">
                {{ $sejarah && $sejarah->judul ? $sejarah->judul : 'Sejarah Sekolah' }}
            </h1>
            <div class="sejarah-divider"></div>
        </div>
    </div>

    <div class="sejarah-container">

        @if(count($historyImages) > 0)

            {{-- Gallery --}}
            <div class="sejarah-gallery-section">
                <div class="section-header">
                    <i class="bi bi-images"></i>
                    <h3>Galeri Foto</h3>
                </div>

                <div class="gallery-card-wrapper">
                    <div class="sejarah-gallery-grid">
                        @foreach($historyImages as $image)
                            <div class="gallery-item">
                                <img 
                                    src="{{ asset('storage/' . $image->image_path) }}" 
                                    alt="Foto Sejarah"
                                    onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}')"
                                    tabindex="0"
                                    role="button"
                                    aria-label="Zoom foto sejarah"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Description --}}
            @if($description)
                <div class="sejarah-description">
                    <div class="desc-icon">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <div class="desc-content">
                        <h3>Tentang Sejarah</h3>
                        <p>{{ $description }}</p>
                    </div>
                </div>
            @endif

        @else
            <div class="sejarah-empty">
                <i class="bi bi-clock-history"></i>
                <p>Belum ada data sejarah yang tersedia.</p>
            </div>
        @endif

    </div>
</div>

{{-- LIGHTBOX MODAL --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()" role="dialog" aria-modal="true" aria-label="Gambar zoom sejarah">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <button class="close-btn" onclick="closeLightbox()" aria-label="Tutup zoom gambar">&times;</button>
        <img id="lightbox-img" alt="Gambar zoom sejarah">
    </div>
</div>

<style>
/* WRAPPER */
.sejarah-wrapper {
    font-family: 'Segoe UI', Arial, sans-serif;
    color: #333;
    background-color: #f4f6f9;
    min-height: 80vh;
}

/* HERO NAVY */
.sejarah-hero {
    background: #0b1f3a;
    padding: 60px 20px 50px;
    text-align: center;
}

.sejarah-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #ffffff;
}

.sejarah-container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 50px 20px 60px;
}

/* GALLERY WRAPPER CARD */
.gallery-card-wrapper {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    display: flex;
    justify-content: center;
}

/* FLEX GALERI SELALU */
.sejarah-gallery-grid {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    width: 100%;
}

/* gambar gallery */
.gallery-item {
    aspect-ratio: 4/3;
    overflow: hidden;
    border-radius: 8px;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    display: block;
}

.gallery-item img:hover,
.gallery-item img:focus {
    outline: none;
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* DESCRIPTION */
.sejarah-description {
    background: #ffffff;
    border-left: 5px solid #0b1f3a;
    border-radius: 8px;
    padding: 30px;
    margin-top: 40px;
}

.desc-icon {
    font-size: 2rem;
    color: #0b1f3a;
    margin-top: 2px;
    flex-shrink: 0;
}

.desc-content h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0b1f3a;
    margin-bottom: 10px;
}

.desc-content p {
    color: #555;
    line-height: 1.8;
    margin: 0;
    white-space: pre-line;
}

/* EMPTY STATE */
.sejarah-empty {
    text-align: center;
    padding: 80px 20px;
    color: #aaa;
}

.sejarah-empty i {
    font-size: 4rem;
    margin-bottom: 16px;
    display: block;
    color: #ccc;
}

/* LIGHTBOX MODAL */
.lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}

.lightbox-content {
    position: relative;
    max-width: 60vw;
    max-height: 60vh;
    background: transparent;
    border-radius: 10px;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
    box-shadow: 0 0 30px rgba(255,255,255,0.8);
    user-select: none;
}

.close-btn {
    position: absolute;
    top: -30px;
    right: -30px;
    background: #222;
    color: #fff;
    border: none;
    font-size: 36px;
    font-weight: bold;
    border-radius: 50%;
    width: 48px;
    height: 48px;
    cursor: pointer;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
    transition: background-color 0.3s ease;
    z-index: 10;
}

.close-btn:hover,
.close-btn:focus {
    background-color: #444;
    outline: none;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .sejarah-gallery-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .sejarah-title { font-size: 1.7rem; }
    .sejarah-description { flex-direction: column; gap: 12px; }
    .sejarah-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .sejarah-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
}

</style>

<script>
function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    lightboxImg.src = src;
    lightbox.style.display = 'flex';
    document.querySelector('.close-btn').focus();
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        closeLightbox();
    }
});
</script>

@endsection