@extends('layouts.app')
@section('title', 'Home')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --ink:        #0d1b2a;
    --ink-mid:    #1c3144;
    --ink-soft:   #2e4a63;
    --accent:     #e8a87c;
    --accent-dark:#c4834a;
    --accent-soft: #f5d5b5;
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

body {
    font-family: 'DM Sans', sans-serif;
    color: var(--text-body);
    line-height: 1.7;
    background: var(--light-bg);
    overflow-x: hidden;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(232,168,124,0.03) 0%, transparent 30%),
        radial-gradient(circle at 80% 70%, rgba(232,168,124,0.03) 0%, transparent 30%),
        radial-gradient(circle at 40% 80%, rgba(46,74,99,0.03) 0%, transparent 40%),
        radial-gradient(circle at 90% 20%, rgba(46,74,99,0.03) 0%, transparent 40%);
    pointer-events: none;
    z-index: -1;
}

img { display: block; max-width: 100%; height: auto; }

.container {
    max-width: 1160px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
    box-sizing: border-box;
}

.section-light    { background: var(--white); padding: 80px 0; position: relative; overflow: hidden; }
.section-dark     { background: var(--ink); padding: 80px 0; position: relative; overflow: hidden; }
.section-offwhite { background: var(--off-white); padding: 80px 0; position: relative; overflow: hidden; }

/* Background Patterns */
.section-light::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 48%, rgba(232,168,124,0.02) 50%, transparent 52%),
        linear-gradient(-45deg, transparent 48%, rgba(232,168,124,0.02) 50%, transparent 52%);
    background-size: 60px 60px;
    pointer-events: none;
    animation: patternMove 20s linear infinite;
}

.section-light::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(232,168,124,0.03) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    animation: floatSlow 15s ease-in-out infinite;
}

.section-dark::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(232,168,124,0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(232,168,124,0.05) 0%, transparent 50%);
    pointer-events: none;
    animation: glowPulse 8s ease-in-out infinite;
}

.section-dark::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(232,168,124,0.3), transparent);
}

.section-offwhite::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: 
        repeating-linear-gradient(45deg, 
            rgba(232,168,124,0.02) 0px, 
            rgba(232,168,124,0.02) 20px,
            transparent 20px, 
            transparent 40px);
    pointer-events: none;
}

/* Scroll Animation Classes */
.scroll-fade {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), 
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.scroll-fade.show {
    opacity: 1;
    transform: translateY(0);
}

.scroll-scale {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), 
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.scroll-scale.show {
    opacity: 1;
    transform: scale(1);
}

.scroll-left {
    opacity: 0;
    transform: translateX(-50px);
    transition: opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), 
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.scroll-left.show {
    opacity: 1;
    transform: translateX(0);
}

.scroll-right {
    opacity: 0;
    transform: translateX(50px);
    transition: opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), 
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.scroll-right.show {
    opacity: 1;
    transform: translateX(0);
}

.scroll-rotate {
    opacity: 0;
    transform: rotate(-5deg) scale(0.95);
    transition: opacity 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), 
                transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.scroll-rotate.show {
    opacity: 1;
    transform: rotate(0) scale(1);
}

.delay-1 { transition-delay: 0.1s; }
.delay-2 { transition-delay: 0.2s; }
.delay-3 { transition-delay: 0.3s; }
.delay-4 { transition-delay: 0.4s; }
.delay-5 { transition-delay: 0.5s; }

.heading-display {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(1.6rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--ink);
    line-height: 1.2;
    letter-spacing: -0.5px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.heading-light { color: var(--white); }

.body-text {
    font-size: 0.97rem;
    color: var(--text-body);
    line-height: 1.8;
    margin-bottom: 1rem;
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
}

.eyebrow-tag {
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
    max-width: 100%;
    white-space: normal;
    word-break: break-word;
    position: relative;
    overflow: hidden;
}

.eyebrow-tag::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(232,168,124,0.2), transparent 70%);
    animation: rotate 10s linear infinite;
}

.eyebrow-light {
    color: var(--accent);
    background: rgba(232,168,124,0.15);
    border-color: rgba(232,168,124,0.25);
}

.content-divider {
    width: 48px;
    height: 3px;
    background: var(--accent);
    border-radius: 3px;
    margin: 20px 0 28px;
    position: relative;
    overflow: hidden;
}

.content-divider::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, var(--accent-soft), transparent);
    animation: shimmer 2s infinite;
}

.divider-center { margin-left: auto; margin-right: auto; }
.divider-light  { background: rgba(232,168,124,0.6); }

.section-header-center { text-align: center; margin-bottom: 56px; }

/* ===== BUTTONS ===== */
.btn {
    display: inline-block;
    padding: 13px 28px;
    border-radius: 100px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.92rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
    border: none;
    white-space: nowrap;
    position: relative;
    overflow: hidden;
}
.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}
.btn:hover::before {
    width: 300px;
    height: 300px;
}
.btn-sm { padding: 9px 20px; font-size: 0.82rem; }

.btn-accent {
    background: var(--accent);
    color: var(--ink);
    box-shadow: 0 4px 18px rgba(232,168,124,0.35);
}
.btn-accent:hover { 
    background: var(--accent-dark);
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(232,168,124,0.5);
}

.btn-ghost {
    background: transparent;
    color: var(--white);
    border: 1.5px solid rgba(255,255,255,0.4);
}
.btn-ghost:hover { 
    background: rgba(255,255,255,0.1);
    transform: translateY(-3px);
    border-color: rgba(255,255,255,0.8);
}

.btn-primary-dark {
    background: var(--ink);
    color: var(--white);
    box-shadow: var(--shadow-md);
}
.btn-primary-dark:hover { 
    background: var(--ink-mid);
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(232,168,124,0.25);
}

.link-arrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--accent-dark);
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 8px;
    position: relative;
}
.link-arrow::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--accent);
    transition: width 0.3s ease;
}
.link-arrow:hover::after { width: 100%; }
.link-arrow:hover { gap: 14px; }

/* ===== HERO ===== */
.hero-section {
    position: relative;
    background: var(--ink);
    min-height: 620px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 100px 24px 90px;
}

.hero-bg-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(232,168,124,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(232,168,124,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    animation: slideGrid 20s linear infinite;
}

.hero-orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
.hero-orb-1 {
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(232,168,124,0.18) 0%, transparent 70%);
    top: -120px; left: -100px;
    animation: float 8s ease-in-out infinite;
}
.hero-orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(46,74,99,0.5) 0%, transparent 70%);
    bottom: -80px; right: -60px;
    animation: float 10s ease-in-out infinite reverse;
}

.hero-content {
    position: relative; z-index: 2;
    text-align: center; color: var(--white);
    max-width: 820px; width: 100%;
}

.hero-eyebrow {
    display: inline-block;
    font-size: 0.72rem; font-weight: 600;
    letter-spacing: 2.5px; text-transform: uppercase;
    color: var(--accent);
    border: 1px solid rgba(232,168,124,0.3);
    padding: 6px 18px; border-radius: 100px;
    margin-bottom: 24px;
    background: rgba(232,168,124,0.08);
    position: relative;
    overflow: hidden;
}

.hero-eyebrow::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(232,168,124,0.3), transparent 70%);
    animation: rotate 15s linear infinite;
}

.hero-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2rem, 6vw, 4.2rem);
    font-weight: 700; line-height: 1.15;
    margin-bottom: 20px; letter-spacing: -1px;
    color: var(--white);
    word-wrap: break-word;
}
.text-accent { 
    color: var(--accent);
    position: relative;
    display: inline-block;
}
.text-accent::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, transparent, var(--accent), transparent);
    opacity: 0;
    animation: accentPulse 2s ease-in-out infinite;
}

.hero-subtitle {
    font-size: clamp(0.95rem, 2vw, 1.15rem);
    opacity: 0.8; margin-bottom: 40px;
    font-weight: 300;
}

.hero-buttons {
    display: flex; gap: 14px;
    justify-content: center; flex-wrap: wrap;
}

.hero-scroll-indicator {
    position: absolute; bottom: 28px;
    left: 50%; transform: translateX(-50%);
}
.hero-scroll-indicator span {
    display: block; width: 1.5px; height: 44px;
    background: linear-gradient(to bottom, rgba(232,168,124,0.8), transparent);
    animation: scrollPulse 1.8s ease-in-out infinite;
}

/* ===== SPLIT LAYOUT ===== */
.split-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    gap: 60px;
    align-items: center;
    width: 100%;
    overflow: hidden;
}

.split-reverse { direction: rtl; }
.split-reverse > * { direction: ltr; }

.split-image,
.split-content,
.split-stats {
    min-width: 0;
    width: 100%;
    overflow: hidden;
}

.img-frame {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    width: 100%;
    display: block;
}
.img-frame img {
    width: 100%;
    height: clamp(260px, 35vw, 480px);
    object-fit: cover;
    display: block;
    transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.img-frame:hover img { 
    transform: scale(1.08) rotate(1deg);
    filter: brightness(1.1);
}

.img-badge {
    position: absolute; bottom: 20px; left: 20px;
    background: var(--accent); color: var(--ink);
    font-size: 0.78rem; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    padding: 8px 18px; border-radius: 100px;
    z-index: 2;
}

/* ===== VISI MISI ===== */
.vm-grid {
    display: grid;
    grid-template-columns: minmax(0,1fr) minmax(0,1fr);
    gap: 28px;
}

.vm-card {
    border-radius: var(--radius);
    padding: 40px 32px;
    border: 1px solid rgba(255,255,255,0.08);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    overflow: hidden;
    word-wrap: break-word;
    overflow-wrap: break-word;
    position: relative;
}
.vm-card::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.6s ease;
}
.vm-card:hover::before { left: 100%; }
.vm-card:hover { 
    transform: translateY(-8px);
    border-color: rgba(232,168,124,0.4);
    box-shadow: 0 20px 50px rgba(232,168,124,0.15);
}
.vm-visi {
    background: linear-gradient(135deg, rgba(232,168,124,0.18) 0%, rgba(232,168,124,0.06) 100%);
    border-color: rgba(232,168,124,0.2);
}
.vm-misi { background: rgba(255,255,255,0.04); }

.vm-icon-wrap { 
    font-size: 44px; margin-bottom: 18px; line-height: 1;
}

.vm-label {
    font-size: 0.72rem; font-weight: 700;
    letter-spacing: 3px; color: var(--accent);
    margin-bottom: 14px;
}

.vm-card p {
    color: rgba(255,255,255,0.8);
    font-size: 0.97rem; line-height: 1.8;
    word-wrap: break-word; overflow-wrap: break-word;
    position: relative;
    z-index: 1;
}

.misi-list { list-style: none; }
.misi-list li {
    display: flex; align-items: flex-start;
    gap: 14px; padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    color: rgba(255,255,255,0.8);
    font-size: 0.92rem; line-height: 1.6;
    word-wrap: break-word; overflow-wrap: break-word;
    transition: all 0.3s ease;
}
.misi-list li:hover { 
    color: var(--accent);
    padding-left: 20px;
}
.misi-list li:last-child { border-bottom: none; }

.misi-num {
    flex-shrink: 0;
    width: 30px; height: 30px; border-radius: 50%;
    background: rgba(232,168,124,0.2);
    border: 1px solid rgba(232,168,124,0.3);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.72rem; font-weight: 700; color: var(--accent);
    transition: all 0.3s ease;
}
.misi-list li:hover .misi-num {
    background: rgba(232,168,124,0.5);
    transform: scale(1.1) rotate(360deg);
}

/* ===== SEJARAH STATS ===== */
.split-stats {
    display: flex; flex-direction: column; gap: 18px;
}

.stat-card {
    background: var(--off-white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 28px 30px;
    display: flex; flex-direction: column; gap: 6px;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: var(--shadow-sm);
    word-wrap: break-word; overflow-wrap: break-word;
    position: relative;
    overflow: hidden;
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 100px; height: 100px;
    background: radial-gradient(circle, rgba(232,168,124,0.2), transparent);
    border-radius: 50%;
    transform: translate(30px, -30px);
    transition: all 0.6s ease;
}
.stat-card:hover::before {
    transform: translate(0, 0);
}
.stat-card:hover { 
    transform: translateX(8px);
    border-color: var(--accent);
    box-shadow: var(--shadow-lg);
}
.stat-card-accent { background: var(--ink); border-color: var(--ink); }
.stat-card-accent .stat-num { color: var(--accent); }
.stat-card-accent .stat-lbl { color: rgba(255,255,255,0.7); }

.stat-num {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    font-weight: 700; color: var(--ink); line-height: 1;
    position: relative;
    z-index: 1;
}
.stat-lbl {
    font-size: 0.83rem; color: var(--text-muted);
    font-weight: 500; letter-spacing: 0.5px;
    position: relative;
    z-index: 1;
}

/* ===== FASILITAS ===== */
.fasilitas-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0,1fr));
    gap: 20px; margin-top: 48px;
}

.fasilitas-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px 22px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    word-wrap: break-word;
    position: relative;
}
.fasilitas-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 100%; height: 3px;
    background: linear-gradient(90deg, var(--accent-dark), var(--accent));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.fasilitas-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
    border-color: var(--accent);
}
.fasilitas-card:hover::after {
    transform: scaleX(1);
}

.fasilitas-icon-box {
    width: 60px; height: 60px;
    border-radius: 12px; background: var(--ink);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px; font-size: 26px;
    transition: all 0.4s ease; 
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}
.fasilitas-icon-box::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(232,168,124,0.4), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.fasilitas-card:hover .fasilitas-icon-box { 
    background: var(--accent);
    transform: scale(1.1) rotate(-5deg);
}
.fasilitas-card:hover .fasilitas-icon-box::before {
    opacity: 1;
}
.fasilitas-icon-box img { width: 36px; height: 36px; object-fit: cover; border-radius: 8px; }

.fasilitas-card h4 {
    font-size: 0.98rem; font-weight: 700;
    color: var(--ink); margin-bottom: 8px;
    word-wrap: break-word;
    transition: color 0.3s ease;
}
.fasilitas-card:hover h4 {
    color: var(--accent);
}
.fasilitas-card p {
    font-size: 0.87rem; color: var(--text-muted);
    line-height: 1.6; margin: 0;
    word-wrap: break-word; overflow-wrap: break-word;
}

/* ===== PRESTASI ===== */
.prestasi-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0,1fr));
    gap: 24px; margin-top: 48px;
}

.prestasi-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius);
    padding: 36px 24px 28px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative; overflow: hidden;
    word-wrap: break-word;
}
.prestasi-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, rgba(232,168,124,0.2), transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
}
.prestasi-card::after {
    content: '';
    position: absolute;
    inset: 0 0 auto 0; height: 3px;
    background: linear-gradient(90deg, var(--accent-dark), var(--accent));
    opacity: 0; transition: opacity 0.3s ease;
    z-index: 1;
}
.prestasi-card:hover { 
    background: rgba(255,255,255,0.08);
    transform: translateY(-10px);
    border-color: rgba(232,168,124,0.25);
    box-shadow: 0 20px 60px rgba(232,168,124,0.2);
}
.prestasi-card:hover::before { opacity: 1; }
.prestasi-card:hover::after { opacity: 1; }

.prestasi-medal {
    width: 76px; height: 76px;
    margin: 0 auto 20px; border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-dark), var(--accent));
    display: flex; align-items: center; justify-content: center;
    font-size: 34px;
    box-shadow: 0 8px 28px rgba(232,168,124,0.35);
    border: 3px solid rgba(255,255,255,0.15);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}
.prestasi-card:hover .prestasi-medal { 
    transform: scale(1.15) rotateY(360deg);
    box-shadow: 0 15px 40px rgba(232,168,124,0.5);
}
.medal-img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

.prestasi-title {
    font-size: 0.97rem; font-weight: 700;
    color: var(--white); margin-bottom: 10px; line-height: 1.4;
    word-wrap: break-word; overflow-wrap: break-word;
    position: relative;
    z-index: 1;
    transition: color 0.3s ease;
}
.prestasi-card:hover .prestasi-title {
    color: var(--accent);
}
.prestasi-desc {
    font-size: 0.85rem; color: rgba(255,255,255,0.6);
    line-height: 1.7; margin-bottom: 18px;
    word-wrap: break-word; overflow-wrap: break-word;
    position: relative;
    z-index: 1;
}
.prestasi-footer { 
    padding-top: 14px; 
    border-top: 1px solid rgba(255,255,255,0.08);
    position: relative;
    z-index: 1;
}

.empty-state {
    grid-column: 1/-1; text-align: center; padding: 60px;
    background: rgba(255,255,255,0.04);
    border-radius: var(--radius);
    border: 1px dashed rgba(255,255,255,0.15);
}
.empty-icon { font-size: 52px; opacity: 0.4; margin-bottom: 14px; }
.empty-state p { color: rgba(255,255,255,0.5); }

/* ===== ESKUL ===== */
.eskul-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0,1fr));
    gap: 20px; margin-top: 48px;
}

.eskul-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 30px 22px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    word-wrap: break-word;
    position: relative;
}
.eskul-card::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(232,168,124,0.1), transparent);
    border-radius: 50%;
    transition: all 0.6s ease;
    pointer-events: none;
}
.eskul-card:hover {
    border-color: var(--ink);
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}
.eskul-card:hover::before {
    top: 50%;
    left: 50%;
}

.eskul-icon { 
    font-size: 42px; margin-bottom: 16px; line-height: 1;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.eskul-card:hover .eskul-icon {
    transform: scale(1.2) rotateZ(-10deg);
}
.eskul-card h4 {
    font-size: 0.98rem; font-weight: 700;
    color: var(--ink); margin-bottom: 8px;
    word-wrap: break-word;
    transition: color 0.3s ease;
}
.eskul-card:hover h4 {
    color: var(--accent);
}
.eskul-card p {
    font-size: 0.87rem; color: var(--text-muted);
    line-height: 1.6; margin: 0;
    word-wrap: break-word; overflow-wrap: break-word;
}
.pembina-label {
    font-size: 0.8rem; color: var(--accent-dark);
    font-weight: 600; margin-top: 10px !important;
}

.cta-section {
    position: relative; background: var(--ink);
    padding: 90px 24px; text-align: center; overflow: hidden;
}
.cta-glow {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%,-50%);
    width: 600px; height: 300px;
    background: radial-gradient(ellipse, rgba(232,168,124,0.12) 0%, transparent 70%);
    pointer-events: none;
    animation: pulse 4s ease-in-out infinite;
}
.cta-sub {
    font-size: 1rem; color: rgba(255,255,255,0.7);
    margin: 16px auto 36px; max-width: 520px; font-weight: 300;
    word-wrap: break-word;
}

.text-center { text-align: center; }
.mt-5 { margin-top: 44px; }

/* ===== ANIMATIONS ===== */
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideInRight { from { opacity: 0; transform: translateX(-40px); } to { opacity: 1; transform: translateX(0); } }
@keyframes zoomIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
@keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-30px); } }
@keyframes floatSlow { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(20px, -20px); } }
@keyframes slideGrid { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }
@keyframes scrollPulse { 0%, 100% { opacity: 0.4; transform: scaleY(0.6); transform-origin: top; } 50% { opacity: 1; transform: scaleY(1); transform-origin: top; } }
@keyframes expandWidth { from { width: 0; } to { width: 48px; } }
@keyframes accentPulse { 0%, 100% { opacity: 0; } 50% { opacity: 1; } }
@keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
@keyframes countUp { from { opacity: 0; transform: scale(0.5); } to { opacity: 1; transform: scale(1); } }
@keyframes pulse { 0%, 100% { opacity: 0.8; transform: translate(-50%, -50%) scale(1); } 50% { opacity: 1; transform: translate(-50%, -50%) scale(1.1); } }
@keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
@keyframes shimmer { 0% { left: -100%; } 100% { left: 100%; } }
@keyframes glowPulse { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; } }
@keyframes patternMove { 0% { background-position: 0 0; } 100% { background-position: 60px 60px; } }

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .fasilitas-grid  { grid-template-columns: repeat(3, minmax(0,1fr)); }
    .prestasi-grid   { grid-template-columns: repeat(3, minmax(0,1fr)); }
    .eskul-grid      { grid-template-columns: repeat(3, minmax(0,1fr)); }
}

@media (max-width: 900px) {
    .fasilitas-grid  { grid-template-columns: repeat(2, minmax(0,1fr)); }
    .prestasi-grid   { grid-template-columns: repeat(2, minmax(0,1fr)); }
    .eskul-grid      { grid-template-columns: repeat(2, minmax(0,1fr)); }
}

@media (max-width: 768px) {
    .section-light, .section-dark, .section-offwhite { padding: 56px 0; }
    .container { padding: 0 16px; }

    .profil-preview .split-layout {
        grid-template-columns: 110px minmax(0,1fr) !important;
        gap: 16px;
        align-items: flex-start;
    }
    .profil-preview .img-frame img {
        height: 140px;
        border-radius: 12px;
    }
    .profil-preview .img-badge {
        font-size: 0.6rem;
        padding: 5px 10px;
        bottom: 8px; left: 8px;
    }
    .profil-preview .split-content .heading-display {
        font-size: 1rem;
    }
    .profil-preview .split-content .body-text {
        font-size: 0.82rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .profil-preview .content-divider { margin: 10px 0 12px; }

    .sejarah-preview .split-layout {
        grid-template-columns: 1fr !important;
        gap: 24px;
        direction: ltr;
    }
    .sejarah-preview .split-stats {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
    }
    .sejarah-preview .stat-card { flex: 1 1 calc(50% - 5px); }
    .sejarah-preview .sejarah-photo-grid { grid-template-columns: repeat(3,1fr); }

    .vm-grid {
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .vm-card { padding: 22px 16px; }
    .vm-icon-wrap { font-size: 30px; margin-bottom: 10px; }
    .vm-card p, .misi-list li { font-size: 0.82rem; }

    .fasilitas-grid  { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
    .prestasi-grid   { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
    .eskul-grid      { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }

    .fasilitas-card, .eskul-card { padding: 20px 14px; }
    .prestasi-card { padding: 24px 14px 20px; }
    .prestasi-medal { width: 56px; height: 56px; font-size: 26px; }
}

@media (max-width: 480px) {
    .section-light, .section-dark, .section-offwhite { padding: 44px 0; }
    .container { padding: 0 14px; }

    .hero-section { min-height: auto; padding: 72px 16px 64px; }
    .hero-title { font-size: 1.7rem; }
    .hero-buttons { flex-direction: column; align-items: center; }
    .hero-buttons .btn { width: 100%; text-align: center; max-width: 260px; }

    .profil-preview .split-layout {
        grid-template-columns: 90px minmax(0,1fr) !important;
        gap: 12px;
    }
    .profil-preview .img-frame img { height: 115px; }

    .vm-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
    .vm-card { padding: 18px 12px; }

    .fasilitas-grid  { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .prestasi-grid   { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }
    .eskul-grid      { grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; }

    .fasilitas-card h4, .eskul-card h4 { font-size: 0.85rem; }
    .fasilitas-card p, .eskul-card p { font-size: 0.78rem; }
    .prestasi-title { font-size: 0.85rem; }
    .prestasi-desc { font-size: 0.78rem; }

    .stat-card { flex: 1 1 100%; }
    .img-frame img { height: 220px; }
    .vm-card { padding: 20px 14px; }
}
</style>

<section class="hero-section">
    <div class="hero-bg-grid"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-content">
        <span class="hero-eyebrow scroll-fade">Sekolah Unggulan Berkarakter</span>
        <h1 class="hero-title scroll-fade delay-1">Selamat Datang di <br><span class="text-accent">SMK SLB</span></h1>
        <p class="hero-subtitle scroll-fade delay-2">Membangun Generasi Cerdas, Kompeten, dan Berkarakter Islami</p>
        <div class="hero-buttons scroll-fade delay-3">
            <a href="{{ route('profil.menu', 'visi-misi') }}" class="btn btn-accent">Visi & Misi</a>
            <a href="{{ route('fasilitas.index') }}" class="btn btn-ghost">Jelajahi Fasilitas</a>
        </div>
    </div>
    <div class="hero-scroll-indicator"><span></span></div>
</section>

<section class="section-light profil-preview">
    <div class="container">
        <div class="split-layout">
            <div class="split-image scroll-left">
                <div class="img-frame">
                    @if($sambutan && $sambutan->gambar)
                        <img src="{{ asset('assets/' . $sambutan->gambar) }}" alt="{{ $sambutan->judul }}">
                    @else
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;border-radius:12px;"><rect width="200" height="200" fill="#e2e8f0"/><circle cx="100" cy="80" r="40" fill="#94a3b8"/><ellipse cx="100" cy="180" rx="65" ry="45" fill="#94a3b8"/></svg>
                    @endif
                    <div class="img-badge scroll-scale delay-2">Kepala Sekolah</div>
                </div>
            </div>
            <div class="split-content scroll-right">
                <span class="eyebrow-tag">Profil Sekolah</span>
                <h2 class="heading-display">
                    @if($sambutan && $sambutan->judul) {{ $sambutan->judul }} @else Sambutan Kepala Sekolah @endif
                </h2>
                <div class="content-divider"></div>
                <p class="body-text">
                    @if($sambutan && $sambutan->konten)
                        {{ Str::limit(strip_tags($sambutan->konten), 300) }}
                    @else
                        Assalamu'alaikum Warahmatullahi Wabarakatuh. Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa, karena atas rahmat dan karunia-Nya, kita semua masih diberikan kesehatan dan kesempatan untuk terus berkarya dalam dunia pendidikan.
                    @endif
                </p>
                <a href="{{ route('profil.menu', 'sambutan') }}" class="link-arrow">Baca Selengkapnya <span>→</span></a>
            </div>
        </div>
    </div>
</section>

<section class="section-dark vm-section">
    <div class="container">
        <div class="section-header-center scroll-fade">
            <span class="eyebrow-tag eyebrow-light">Tentang Kami</span>
            <h2 class="heading-display heading-light">Visi & Misi</h2>
            <div class="content-divider divider-center divider-light"></div>
        </div>
        <div class="vm-grid">
            <div class="vm-card vm-visi scroll-left">
                <div class="vm-icon-wrap">👁️</div>
                <h3 class="vm-label">VISI</h3>
                <p>
                    @if($visimisi && $visimisi->isi_visi) {!! nl2br(e($visimisi->isi_visi)) !!}
                    @elseif($visimisi && $visimisi->konten) {!! nl2br(e($visimisi->konten)) !!}
                    @else Menjadi sekolah menengah kejuruan yang menghasilkan lulusan cerdas, kompeten, dan berkarakter Islami, serta mampu bersaing di tingkat nasional maupun internasional.
                    @endif
                </p>
            </div>
            <div class="vm-card vm-misi scroll-right">
                <div class="vm-icon-wrap">🎯</div>
                <h3 class="vm-label">MISI</h3>
                @if($visimisi && $visimisi->isi_misi)
                    <p style="color:rgba(255,255,255,0.8);line-height:1.8;">{!! nl2br(e($visimisi->isi_misi)) !!}</p>
                @else
                    <ul class="misi-list">
                        <li><span class="misi-num">01</span>Pendidikan berkualitas relevan kebutuhan dunia kerja</li>
                        <li><span class="misi-num">02</span>Kompetensi keahlian sesuai standar industri</li>
                        <li><span class="misi-num">03</span>Karakter Islami yang kuat dan berintegritas</li>
                        <li><span class="misi-num">04</span>Prestasi akademik dan non-akademik tinggi</li>
                        <li><span class="misi-num">05</span>Kerjasama erat dengan dunia industri</li>
                    </ul>
                @endif
            </div>
        </div>
        <div class="text-center mt-5 scroll-scale">
            <a href="{{ route('profil.menu', 'visi-misi') }}" class="btn btn-accent">Selengkapnya</a>
        </div>
    </div>
</section>

<section class="section-light sejarah-preview">
    <div class="container">
        <div class="split-layout split-reverse">
            <div class="split-content scroll-left">
                <span class="eyebrow-tag">Perjalanan Kami</span>
                <h2 class="heading-display">
                    @if($sejarah && $sejarah->judul) {{ $sejarah->judul }} @else Sejarah Sekolah @endif
                </h2>
                <div class="content-divider"></div>
                
                <!-- Description with blur effect -->
                @if($sejarah && $sejarah->description)
                    <div class="sejarah-preview-text">
                        <p class="body-text">{{ Str::limit(strip_tags($sejarah->description), 150) }}</p>
                    </div>
                @elseif($sejarah && $sejarah->konten)
                    <div class="sejarah-preview-text">
                        <p class="body-text">{{ Str::limit(strip_tags($sejarah->konten), 150) }}</p>
                    </div>
                @else
                    <p class="body-text">Belum ada data sejarah.</p>
                @endif
                
                <a href="{{ route('profil.menu', 'sejarah') }}" class="link-arrow">Baca Selengkapnya <span>→</span></a>
            </div>
            <div class="split-stats scroll-right">
                <!-- Photo Gallery from historyImages -->
                @if($sejarah && $sejarah->historyImages && $sejarah->historyImages->count() > 0)
                    <div class="sejarah-photo-card">
                        <div class="sejarah-photo-grid">
                            @foreach($sejarah->historyImages->take(3) as $index => $image)
                                <div class="sejarah-photo-item scroll-scale delay-{{ $index + 1 }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Foto Sejarah {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="stat-card scroll-left">
                        <span class="stat-num">{{ $tahunBerdiri }}</span>
                        <span class="stat-lbl">Tahun Berdiri</span>
                    </div>
                    <div class="stat-card stat-card-accent scroll-right delay-2">
                        <span class="stat-num">{{ $lamaBeroperasi }}+</span>
                        <span class="stat-lbl">Tahun Berpengalaman</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
.sejarah-preview-text {
    position: relative;
    max-height: 80px;
    overflow: hidden;
}
.sejarah-preview-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
    background: linear-gradient(transparent, var(--white));
}

.sejarah-photo-card {
    background: var(--off-white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px;
    box-shadow: var(--shadow-sm);
}

.sejarah-photo-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.sejarah-photo-item {
    border-radius: 8px;
    overflow: hidden;
}

.sejarah-photo-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
}

.sejarah-photo-item:hover img {
    transform: scale(1.05);
}

.sejarah-photo-grid:only-child {
    display: flex;
    justify-content: center;
}

.sejarah-photo-grid:only-child .sejarah-photo-item {
    max-width: 200px;
}
</style>

<section class="section-offwhite fasilitas-preview">
    <div class="container">
        <div class="section-header-center scroll-fade">
            <span class="eyebrow-tag">Sarana & Prasarana</span>
            <h2 class="heading-display">Fasilitas Unggulan</h2>
            <div class="content-divider divider-center"></div>
            <p class="body-text text-center" style="max-width:560px;margin:0 auto;">Dilengkapi dengan fasilitas modern untuk mendukung proses pembelajaran optimal</p>
        </div>
        <div class="fasilitas-grid">
            @forelse($fasilitas as $index => $item)
            <div class="fasilitas-card scroll-scale delay-{{ $index + 1 }}">
                <div class="fasilitas-icon-box">
                    @if($item->gambar)
                        <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_fasilitas }}">
                    @else
                        <span>🏫</span>
                    @endif
                </div>
                <h4>{{ $item->nama_fasilitas }}</h4>
                <p>{{ $item->deskripsi }}</p>
            </div>
            @empty
            <div class="fasilitas-card" style="grid-column:1/-1;text-align:center;padding:40px;">
                <p style="color:var(--text-muted);">Belum ada data fasilitas.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5 scroll-fade">
            <a href="{{ route('fasilitas.index') }}" class="btn btn-primary-dark">Jelajahi Semua Fasilitas</a>
        </div>
    </div>
</section>

<section class="section-dark prestasi-preview">
    <div class="container">
        <div class="section-header-center scroll-fade">
            <span class="eyebrow-tag eyebrow-light">Keunggulan</span>
            <h2 class="heading-display heading-light">Prestasi & Penghargaan</h2>
            <div class="content-divider divider-center divider-light"></div>
        </div>
        <div class="prestasi-grid">
            @forelse($prestasis as $index => $item)
            <div class="prestasi-card scroll-scale delay-{{ $index + 1 }}">
                <div class="prestasi-medal">
                    @if($item->foto)
                        <img src="{{ asset('assets/' . $item->foto) }}" alt="{{ $item->nama_prestasi }}" class="medal-img">
                    @else
                        🏆
                    @endif
                </div>
                <h4 class="prestasi-title">{{ $item->nama_prestasi }}</h4>
                <p class="prestasi-desc">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                <div class="prestasi-footer">
                    <a href="{{ route('prestasi.index') }}" class="btn btn-accent btn-sm">Selengkapnya</a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">🏆</div>
                <p>Belum ada data prestasi yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5 scroll-fade">
            <a href="{{ route('prestasi.index') }}" class="btn btn-ghost">Lihat Semua Prestasi</a>
        </div>
    </div>
</section>

<section class="section-light eskul-preview">
    <div class="container">
        <div class="section-header-center scroll-fade">
            <span class="eyebrow-tag">Pengembangan Diri</span>
            <h2 class="heading-display">Program Ekstrakurikuler</h2>
            <div class="content-divider divider-center"></div>
            <p class="body-text text-center" style="max-width:560px;margin:0 auto;">Berbagai pilihan kegiatan untuk mengembangkan bakat dan minat siswa</p>
        </div>
        <div class="eskul-grid">
            @forelse($eskuls as $index => $item)
            <div class="eskul-card scroll-scale delay-{{ $index + 1 }}">
                <div class="eskul-icon">
                    @if($item->gambar)
                        <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->nama_eskul }}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;">
                    @else
                        🎯
                    @endif
                </div>
                <h4>{{ $item->nama_eskul }}</h4>
                <p>{{ $item->deskripsi }}</p>
                @if($item->pembina)
                <p class="pembina-label">Pembina: {{ $item->pembina }}</p>
                @endif
            </div>
            @empty
            <div class="eskul-card" style="grid-column:1/-1;text-align:center;padding:40px;">
                <p style="color:var(--text-muted);">Belum ada data ekstrakurikuler.</p>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5 scroll-fade">
            <a href="{{ route('eskul.index') }}" class="btn btn-primary-dark">Daftar Ekstrakurikuler</a>
        </div>
    </div>
</section>

<section class="section-light struktur-preview">
    <div class="container">
        <div class="section-header-center scroll-fade">
            <span class="eyebrow-tag">Tim Kerja</span>
            <h2 class="heading-display">Struktur Organisasi</h2>
            <div class="content-divider divider-center"></div>
            <p class="body-text text-center" style="max-width:560px;margin:0 auto;">Kenali tim kepemimpinan dan staf kami yang berdedikasi untuk membangun sekolah terbaik</p>
        </div>
        
        <div class="struktur-grid">
            @forelse($strukturs as $index => $item)
            <div class="struktur-card scroll-scale delay-{{ $index + 1 }}">
                <div class="struktur-photo">
                    @if($item->gambar)
                        <img src="{{ asset('assets/' . $item->gambar) }}" alt="{{ $item->jabatan }}">
                    @else
                        <div class="struktur-photo-placeholder">
                            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;border-radius:50%;">
                                <circle cx="50" cy="50" r="50" fill="#e2e8f0"/>
                                <circle cx="50" cy="38" r="18" fill="#94a3b8"/>
                                <ellipse cx="50" cy="85" rx="30" ry="20" fill="#94a3b8"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="struktur-info">
                    <h4 class="struktur-jabatan">{!! nl2br(e($item->jabatan)) !!}</h4>
                    @if($item->nama)
                        <p class="struktur-nama">{!! nl2br(e($item->nama)) !!}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="struktur-empty" style="grid-column: 1/-1; text-align: center; padding: 40px;">
                <div class="empty-icon" style="font-size: 48px; margin-bottom: 16px;">👥</div>
                <p style="color: var(--text-muted);">Belum ada data struktur organisasi.</p>
            </div>
            @endforelse
        </div>
        
        @if($strukturs->count() > 0)
        <div class="text-center mt-5 scroll-fade">
            <a href="{{ route('profil.struktur') }}" class="btn btn-primary-dark">Lihat Selengkapnya</a>
        </div>
        @endif
    </div>
</section>

<style>
.struktur-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 24px;
    margin-top: 48px;
}

.struktur-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 32px 20px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    position: relative;
}

.struktur-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-dark), var(--accent));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.struktur-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
    border-color: var(--accent);
}

.struktur-card:hover::before {
    transform: scaleX(1);
}

.struktur-photo {
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--accent);
    padding: 3px;
    background: var(--off-white);
    transition: all 0.4s ease;
}

.struktur-card:hover .struktur-photo {
    transform: scale(1.1);
    border-color: var(--accent-dark);
}

.struktur-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.struktur-photo-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
}

.struktur-info {
    position: relative;
    z-index: 1;
}

.struktur-jabatan {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 6px;
    word-wrap: break-word;
    transition: color 0.3s ease;
}

.struktur-card:hover .struktur-jabatan {
    color: var(--accent-dark);
}

.struktur-nama {
    font-size: 0.88rem;
    color: var(--text-muted);
    font-style: italic;
    margin: 0;
    word-wrap: break-word;
}

@media (max-width: 1024px) {
    .struktur-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 900px) {
    .struktur-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .struktur-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .struktur-card {
        padding: 24px 14px;
    }
    
    .struktur-photo {
        width: 80px;
        height: 80px;
        margin-bottom: 14px;
    }
    
    .struktur-jabatan {
        font-size: 0.85rem;
    }
    
    .struktur-nama {
        font-size: 0.8rem;
    }
}

@media (max-width: 400px) {
    .struktur-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<section class="cta-section">
    <div class="cta-glow"></div>
    <div class="container text-center">

        <span class="eyebrow-tag eyebrow-light">Bergabung Bersama Kami</span>
        <h2 class="heading-display heading-light" style="margin-top:12px;">Siap Wujudkan Masa Depan Cerah?</h2>
        <p class="cta-sub">Daftarkan diri Anda dan jadilah bagian dari komunitas sekolah kami yang berprestasi</p>
        <div class="hero-buttons">
            <a href="https://wa.me/628112224563?text=Halo%20saya%20ingin%20bertanya" class="btn btn-accent">Hubungi Kami</a>
            <a href="{{ route('pesan.index') }}" class="btn btn-ghost">Saran</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                // Optional: unobserve after showing
                // observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with scroll animation classes
    document.querySelectorAll('.scroll-fade, .scroll-scale, .scroll-left, .scroll-right, .scroll-rotate').forEach(el => {
        observer.observe(el);
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-section');
        if (hero) {
            const orbs = hero.querySelectorAll('.hero-orb');
            orbs.forEach((orb, index) => {
                const speed = index === 0 ? 0.3 : 0.5;
                orb.style.transform = `translateY(${scrolled * speed}px)`;
            });
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

@endsection