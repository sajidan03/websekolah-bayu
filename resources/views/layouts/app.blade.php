<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Sekolah')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2c3e50;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar .logo .logo-img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        .navbar .logo:hover {
            color: #1abc9c;
        }

        /* HANYA UL UTAMA YANG FLEX */
        .navbar>ul {
            list-style: none;
            display: flex;
        }

        .navbar>ul>li {
            position: relative;
            margin-left: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            padding: 10px 0;
            display: inline-block;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #1abc9c;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        /* ================= DROPDOWN ================= */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #34495e;
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: 200px;
            border-radius: 5px;
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu li {
            display: block;
        }

        .dropdown-menu li a {
            display: block;
            padding: 12px 15px;
            color: white;
        }

        .dropdown-menu li a:hover {
            background-color: #1abc9c;
            color: white;
        }

        /* Hover Desktop */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {

            .navbar>ul {
                flex-direction: column;
                background: #34495e;
                position: absolute;
                top: 60px;
                right: 0;
                width: 220px;
                display: none;
                padding: 10px 0;
            }

            .navbar>ul.active {
                display: flex;
            }

            .navbar>ul>li {
                margin: 0;
                padding: 0 20px;
            }

            .menu-toggle {
                display: block;
            }

            /* Dropdown Mobile */
            .dropdown-menu {
                position: static;
                background-color: #3b536b;
            }

            .dropdown:hover .dropdown-menu {
                display: none;
            }

            .dropdown.active .dropdown-menu {
                display: block;
            }
        }

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            padding: 20px;
        }

        /* ================= FOOTER ================= */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 30px 20px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }

        .footer-column h3 {
            margin-bottom: 10px;
            color: #ffffff;
        }

        .footer-column p {
            color: #bdc3c7;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 8px;
        }

        .footer-column ul li a {
            text-decoration: none;
            color: #bdc3c7;
        }

        .footer-column ul li a:hover {
            color: #1abc9c;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #7f8c8d;
            font-size: 14px;
        }

        /* ================= SOCIAL ICONS ================= */
        .social-icons {
            margin-top: 15px;
            display: flex;
            gap: 12px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background-color: #1abc9c;
            color: white;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('assets/tutu.png') }}" alt="Logo SMK YPC" class="logo-img">
            <span>SMK YPC</span>
        </a>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <ul id="menu">
            <li><a href="/">Home</a></li>

            <li class="dropdown">
                <a href="{{ route('profil.dashboard') }}" onclick="toggleDropdown(event)">Profil</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('profil.menu', 'sambutan') }}">Sambutan Kepala Sekolah</a></li>
                    <li><a href="{{ route('profil.menu', 'visi-misi') }}">Visi & Misi</a></li>
                    <li><a href="{{ route('profil.menu', 'struktur-organisasi') }}">Struktur Organisasi</a></li>
                    <li><a href="{{ route('profil.menu', 'sejarah') }}">Sejarah</a></li>
                </ul>
            </li>

            <li><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
            <li><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
            <li><a href="{{ route('eskul.index') }}">Eskul</a></li>
        </ul>
    </nav>

    {{-- CONTENT --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="footer-container">

            <div class="footer-column">
                <h3>SMK-YPC</h3>
                <p>
                    Selamat Datang di Portal Resmi SMK YPC Tasikmalaya
                    SMK YPC Tasikmalaya merupakan institusi pendidikan kejuruan swasta terkemuka yang berlokasi di
                    lingkungan Komplek Pesantren Cintawana, Singaparna, Kabupaten Tasikmalaya. Sebagai sekolah yang
                    berkomitmen mencetak generasi GESIT (Religious, Enterprising, Smart, Innovative, Trustworthy), kami
                    memadukan pendidikan karakter islami dengan keahlian teknologi industri terkini. <ul><li><a href="{{ route('login') }}">Login with another level</a></li></ul>
                </p>
            </div>

            <div class="footer-column">
                <h3>Menu</h3>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('profil.dashboard') }}">Profil</a></li>
                    <li><a href="{{ route('fasilitas.index') }}">Fasilitas</a></li>
                    <li><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                    <li><a href="{{ route('eskul.index') }}">Eskul</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Kontak</h3>
                <p>Email: smkypc@gmail.com</p>
                <p>Telp: 0857-9434-8691</p>
                <div class="social-icons">
                    <a href="https://facebook.com/SMK YPC Tasikmalaya" target="_blank"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="https://instagram.com/smksypctasikmalaya" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="https://youtube.com/@smkypctasikmalaya" target="_blank"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} YPC. All rights reserved.
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('active');
        }

        function toggleDropdown(event) {
            if (window.innerWidth <= 768) {
                event.preventDefault();
                event.target.parentElement.classList.toggle('active');
            }
        }
    </script>

</body>

</html>
