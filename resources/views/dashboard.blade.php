<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Destinasi Tourisme - Temanggung</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Navbar CSS -->
    <style>
        .custom-navbar {
            background: linear-gradient(135deg, #1e3a8a 0%, #7c2d12 100%) !important;
            padding: 1rem 0;
            border-bottom: 3px solid #fbbf24;
        }

        .navbar-brand {
            font-size: 1.6rem !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .brand-text {
            color: #ffffff !important;
        }

        .nav-link-custom {
            color: #ffffff !important;
            font-weight: 600 !important;
            padding: 0.75rem 1rem !important;
            margin: 0 0.25rem !important;
            border-radius: 25px !important;
            transition: all 0.3s ease !important;
            text-decoration: none !important;
        }

        .nav-link-custom:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .nav-link-custom.active {
            background-color: #fbbf24 !important;
            color: #1e3a8a !important;
            font-weight: 700 !important;
        }

        .custom-dropdown {
            background-color: #ffffff !important;
            border: none !important;
            border-radius: 15px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2) !important;
            margin-top: 0.5rem !important;
        }

        .custom-dropdown-item {
            color: #374151 !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 10px !important;
            margin: 0.25rem !important;
            transition: all 0.2s ease !important;
        }

        .custom-dropdown-item:hover {
            background-color: #f3f4f6 !important;
            color: #1e3a8a !important;
            transform: translateX(5px);
        }

        .custom-login-btn {
            border: 2px solid #fbbf24 !important;
            color: #fbbf24 !important;
            background: transparent !important;
            font-weight: 600 !important;
            border-radius: 25px !important;
            padding: 0.5rem 1.5rem !important;
            transition: all 0.3s ease !important;
        }

        .custom-login-btn:hover {
            background-color: #fbbf24 !important;
            color: #1e3a8a !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(251, 191, 36, 0.3);
        }

        .navbar-toggler {
            border: 2px solid #fbbf24 !important;
            padding: 0.5rem !important;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(251, 191, 36, 0.5) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28251, 191, 36, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }

        @media (max-width: 991.98px) {
            .nav-link-custom {
                margin: 0.25rem 0 !important;
                text-align: center;
            }

            .custom-login-btn {
                margin-top: 1rem !important;
                display: inline-block !important;
                width: auto !important;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem !important;
            }

            .custom-navbar {
                padding: 0.5rem 0;
            }
        }

        * {
            transition: all 0.3s ease;
        }
    </style>

    <!-- Slideshow Hero CSS -->
    <style>
        .hero-section {
            position: relative;
            height: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .slideshow-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(76, 29, 149, 0.8) 0%, rgba(99, 102, 241, 0.6) 50%, rgba(139, 92, 246, 0.8) 100%);
            z-index: 2;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            right: 50px;
            transform: translateY(-50%);
            z-index: 3;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            max-width: 450px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: slideInRight 1s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateY(-50%) translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateY(-50%) translateX(0);
            }
        }

        .hero-content h3 {
            color: #4c1d95;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .visit-stats {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 15px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 15px;
            color: white;
            font-weight: 600;
        }

        .visit-icon {
            font-size: 1.5rem;
        }

        .visit-count {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }

        .cta-button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        }

        .slideshow-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 4;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: white;
            transform: scale(1.2);
        }

        .slide-counter {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            z-index: 4;
        }

        .destination-name {
            position: absolute;
            bottom: 80px;
            left: 30px;
            background: rgba(255, 255, 255, 0.9);
            color: #4c1d95;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            z-index: 4;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .hero-content {
                right: 20px;
                left: 20px;
                max-width: none;
                padding: 30px 20px;
            }

            .hero-section {
                height: 400px;
            }
        }
    </style>

    <!-- Dashboard Style (CSS dashboard Anda) -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dashboard-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .stat-icon.destinations {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .stat-icon.visitors {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-icon.reviews {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-icon.bookings {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #64748b;
            font-weight: 500;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .welcome-message {
            color: #64748b;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .export-controls {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .export-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .export-btn.excel {
            background: linear-gradient(135deg, #2196F3, #1976D2);
        }

        .export-btn.excel:hover {
            box-shadow: 0 10px 20px rgba(33, 150, 243, 0.3);
        }

        .table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            margin-bottom: 2rem;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 1000px;
        }

        th {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 15px 8px;
            text-align: center;
            font-weight: bold;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        td {
            padding: 12px 8px;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .location-name {
            text-align: left;
            font-weight: bold;
            color: #2d3748;
            max-width: 200px;
            min-width: 180px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tr:hover {
            background-color: #e6fffa;
            transition: background-color 0.3s ease;
        }

        .number-cell {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #2d3748;
        }

        .total-cell {
            background-color: #4CAF50 !important;
            color: white;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding: 0 1rem;
            }

            .export-controls {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    @php $title = 'Dashboard'; @endphp
    <!-- Navbar Bootstrap Custom -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="fas fa-globe-americas me-2 text-warning"></i>
                <span class="brand-text">{{ $title }}</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('map') ? 'active' : '' }}"
                            href="{{ route('map') }}">
                            <i class="fas fa-map-location-dot me-1"></i>
                            <span class="nav-text">Peta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom {{ request()->routeIs('table') ? 'active' : '' }}"
                            href="{{ route('table') }}">
                            <i class="fas fa-table me-1"></i>
                            <span class="nav-text">Table</span>
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom
                            {{ request()->routeIs('api.points') || request()->routeIs('api.polylines') || request()->routeIs('api.polygons') ? 'active' : '' }}"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-database me-1"></i>
                                <span class="nav-text">Data</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                                <li>
                                    <a class="dropdown-item custom-dropdown-item" href="{{ route('api.points') }}"
                                        target="_blank">
                                        <i class="fas fa-map-pin me-2 text-primary"></i>Points
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item custom-dropdown-item" href="{{ route('api.polylines') }}"
                                        target="_blank">
                                        <i class="fas fa-route me-2 text-success"></i>Polylines
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item custom-dropdown-item" href="{{ route('api.polygons') }}"
                                        target="_blank">
                                        <i class="fas fa-draw-polygon me-2 text-warning"></i>Polygons
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                <span class="nav-text">Account</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                                <li>
                                    <h6 class="dropdown-header text-muted">
                                        <i class="fas fa-user me-1"></i>
                                        {{ Auth::user()->name ?? 'User' }}
                                    </h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button type="submit" class="dropdown-item custom-dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light custom-login-btn {{ request()->routeIs('login') ? 'active' : '' }}"
                                href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                <span class="nav-text">Login</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- END Navbar Bootstrap Custom -->

    <main class="main-content">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard Destinasi Pariwisata Kabupaten Temanggung Tahun 2024</h1>
            <p class="dashboard-subtitle">Kelola dan pantau objek wisata Kabupaten Temanggung</p>
        </div>

        <!-- HERO SLIDESHOW -->
        <div class="hero-section">
            <div class="slideshow-container">
                <div class="slide active"
                    style="background-image: url('/storage/images/posong.jpg');">
                </div>
                <div class="slide"
                    style="background-image: url('/storage/images/sigandul.jpg');">
                </div>
                <div class="slide"
                    style="background-image: url('/storage/images/pikatan.jpg');">
                </div>
                <div class="slide"
                    style="background-image: url('/storage/images/rowo.jpeg');">
                </div>
                <div class="slide"
                    style="background-image: url('/storage/images/papringan.jpg');">
                </div>
            </div>
            <div class="hero-overlay"></div>
            <div class="slide-counter">
                <span id="currentSlide">1</span> / <span id="totalSlides">5</span>
            </div>
            <div class="destination-name" id="destinationName">
                🏛️ Sigandul View Coffee & Resto
            </div>
            <div class="hero-content">
                <h3 id="topDestination">🏛️ Taman Posong</h3>
                <div class="visit-stats">
                    <div class="visit-icon">👥</div>
                    <span class="visit-count" id="topVisitors">139.938</span>
                    <span>pengunjung tahun ini</span>
                </div>
                <p class="description" id="destinationDesc">
                    Destinasi wisata terpopuler di Kabupaten Temanggung dengan pemandangan yang menakjubkan dan
                    fasilitas terbaik untuk wisatawan domestik dan mancanegara.
                </p>
                <a href="#data" class="cta-button">Lihat Detail Data</a>
            </div>
            <div class="slideshow-controls">
                <span class="dot active" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
            </div>
        </div>
        <!-- END HERO SLIDESHOW -->

        <div class="stats-grid" id="statsGrid"></div>
        <div class="welcome-card">
            <h2 class="welcome-title">Selamat Datang di Dashboard! 🎉</h2>
            <p class="welcome-message">
                Anda telah berhasil login ke sistem manajemen destinasi pariwisata Kabupaten Temanggung.
                Dashboard ini menampilkan data real pengunjung objek wisata di Kabupaten Temanggung berdasarkan data
                resmi.
                Gunakan fitur export untuk mengunduh data dalam format CSV atau Excel.
            </p>
            <div class="export-controls">
                <button onclick="exportToCSV()" class="export-btn">📥 Export ke CSV</button>
                <button onclick="exportToExcel()" class="export-btn excel">📊 Export ke Excel</button>
                <button onclick="copyToClipboard()" class="export-btn">📋 Copy Data</button>
            </div>
        </div>
        <div class="table-container" id="data">
            <h3 style="margin-bottom: 1.5rem; color: #1e293b; font-size: 1.5rem;">📊 Data Pengunjung Objek Wisata per
                Bulan Tahun 2024</h3>
            <div class="table-wrapper">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Objek Wisata</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Agu</th>
                            <th>Sep</th>
                            <th>Okt</th>
                            <th>Nov</th>
                            <th>Des</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="dataBody"></tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS & Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- Slideshow Script -->
    <script>
        let slideIndex = 1;
        let slideTimer;
        const destinations = [

            {
                name: "🏔️ Taman Posong",
                visitors: "139.938",
                description: "Destinasi wisata alam di lereng Gunung Sindoro yang menyuguhkan panorama pegunungan, sunrise spektakuler, serta udara sejuk khas dataran tinggi Temanggung."
            },
            {
                name: "🏛️ Sigandul View Coffee & Restoo",
                visitors: "128.559",
                description: "Kafe dan tempat wisata yang menawarkan pemandangan pegunungan dan jurang Sigandul, lengkap dengan jembatan kaca dan spot foto Instagramable."
            },
            {
                name: "🌊 Pikatan Water Park",
                visitors: "104.319",
                description: "Taman air keluarga yang dilengkapi berbagai wahana permainan air seru, cocok untuk rekreasi anak-anak dan dewasa di tengah kota Temanggung."
            },
            {
                name: "🌳 Rowo Gembongan",
                visitors: "72.107",
                description: "Danau buatan yang dikelilingi area hijau dan taman bermain, menjadi tempat favorit untuk piknik, bersantai, atau memancing bersama keluarga."
            },
            {
                name: "🎋 Pasar Papringan Ngadiprono",
                visitors: "57.040",
                description: "Pasar tradisional unik di tengah kebun bambu yang menjual produk lokal, makanan khas, dan kerajinan tangan dengan konsep ramah lingkungan dan tanpa plastik."
            }

        ];

        function showSlides(n) {
            const slides = document.getElementsByClassName("slide");
            const dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.remove("active");
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }
            slides[slideIndex - 1].classList.add("active");
            dots[slideIndex - 1].classList.add("active");
            updateContent(slideIndex - 1);
            document.getElementById("currentSlide").textContent = slideIndex;
        }

        function currentSlide(n) {
            clearTimeout(slideTimer);
            slideIndex = n;
            showSlides(slideIndex);
            autoSlide();
        }

        function nextSlide() {
            slideIndex++;
            showSlides(slideIndex);
        }

        function updateContent(index) {
            const destination = destinations[index];
            document.getElementById("topDestination").textContent = destination.name;
            document.getElementById("topVisitors").textContent = destination.visitors;
            document.getElementById("destinationDesc").textContent = destination.description;
            document.getElementById("destinationName").textContent = destination.name;
        }

        function autoSlide() {
            slideTimer = setTimeout(() => {
                slideIndex++;
                showSlides(slideIndex);
                autoSlide();
            }, 5000);
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("totalSlides").textContent = destinations.length;
            showSlides(slideIndex);
            autoSlide();
        });
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.addEventListener('mouseenter', () => {
                clearTimeout(slideTimer);
            });
            heroSection.addEventListener('mouseleave', () => {
                autoSlide();
            });
        }
    </script>

    <!-- Script dashboard Anda tetap di bawah ini -->
    <script>
        const touristData = [{
                name: "Banyu Ciblon Lestari",
                type: "Wisata Alam",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Bukit Kembang Arum",
                type: "wisata buatan",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Embung Bansari",
                type: "Wisata Alam",
                data: [2635, 2023, 1435, 5098, 2868, 2788, 3056, 314, 4639, 354, 3758, 0]
            },
            {
                name: "Kolam Cinta Liyangan",
                type: "wisata buatan",
                data: [1047, 458, 670, 1423, 1762, 1737, 1353, 1187, 1875, 0, 1053, 679]
            },
            {
                name: "Pasar Papringan Ngadiprone",
                type: "wisata buatan",
                data: [4861, 2763, 2140, 2108, 6510, 6326, 7957, 6075, 2993, 3451, 5046, 6810]
            },
            {
                name: "Pikatan Water Park",
                type: "wisata buatan",
                data: [8865, 10399, 8766, 11384, 14152, 11289, 9399, 605, 8972, 11076, 9412, 0]
            },
            {
                name: "Posong",
                type: "Wisata Alam",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Puncak Botorono",
                type: "Wisata Alam",
                data: [103, 94, 612, 612, 0, 89, 112, 92, 0, 0, 0, 0]
            },
            {
                name: "Sedadap",
                type: "Wisata Alam",
                data: [100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Sibajag Green Canyon",
                type: "wisata buatan",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Sigandul View Coffee & Resto",
                type: "wisata buatan",
                data: [7165, 3005, 5000, 13346, 11421, 14559, 16812, 12292, 14034, 10111, 8794, 12020]
            },
            {
                name: "Simpleng Water Park",
                type: "wisata buatan",
                data: [2843, 2512, 4290, 3614, 3821, 4937, 3021, 2419, 2700, 3475, 0, 2832]
            },
            {
                name: "Sindoro Water Park",
                type: "wisata buatan",
                data: [1218, 920, 971, 1529, 1438, 1372, 1096, 1096, 0, 0, 0, 0]
            },
            {
                name: "Taman Posong",
                type: "wisata buatan",
                data: [8000, 8822, 5746, 16266, 13308, 15988, 24229, 12302, 14228, 9773, 11276, 0]
            },
            {
                name: "Taman Wisata Cahaya Langgeng",
                type: "wisata buatan",
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: "Tirto Asri",
                type: "wisata buatan",
                data: [2929, 2410, 2381, 2350, 2930, 2853, 2904, 1983, 2853, 3377, 0, 0]
            },
            {
                name: "Umbul Jumprit",
                type: "Wisata Alam",
                data: [800, 485, 490, 1050, 750, 380, 630, 634, 573, 370, 265, 206]
            },
            {
                name: "Kledung Park",
                type: "Wisata Alam",
                data: [212, 350, 164, 736, 467, 530, 317, 0, 2054, 1581, 1465, 2338]
            },
            {
                name: "Pendakian Gunung Sindoro Kledung",
                type: "Wisata Alam",
                data: [870, 1112, 130, 2137, 2057, 2267, 2097, 3897, 2000, 1500, 1400, 1900]
            },
            {
                name: "Embung Kledung",
                type: "wisata buatan",
                data: [898, 982, 1232, 1402, 1205, 1089, 1576, 2109, 0, 0, 0, 0]
            },
            {
                name: "Rowo Gembongan",
                type: "Wisata Alam",
                data: [8873, 4953, 2575, 6650, 7574, 7742, 8747, 9401, 8218, 6806, 568, 0]
            },
            {
                name: "Candi Pringapus",
                type: "wisata budaya",
                data: [253, 319, 418, 576, 653, 384, 301, 361, 469, 319, 952, 400]
            },
            {
                name: "Liyangan",
                type: "wisata budaya",
                data: [483, 483, 250, 907, 1029, 1099, 794, 424, 1156, 6117, 1296, 868]
            },
            {
                name: "Wapit",
                type: "Wisata Alam",
                data: [598, 729, 530, 819, 986, 565, 954, 691, 1969, 701, 694, 714]
            }
        ];

        function formatNumber(num) {
            return num.toLocaleString('id-ID');
        }

        function renderTable() {
            const tbody = document.getElementById('dataBody');
            tbody.innerHTML = '';

            touristData.forEach((item, index) => {
                const row = document.createElement('tr');
                const total = item.data.reduce((sum, val) => sum + val, 0);

                row.innerHTML = `
                    <td class="number-cell">${index + 1}</td>
                    <td class="location-name">${item.name}</td>
                    ${item.data.map(val => `<td class="number-cell">${formatNumber(val)}</td>`).join('')}
                    <td class="total-cell">${formatNumber(total)}</td>
                `;
                tbody.appendChild(row);
            });
        }

        function renderStats() {
            const statsDiv = document.getElementById('statsGrid');
            const totalLocations = touristData.length;
            const totalVisitors = touristData.reduce((sum, item) => sum + item.data.reduce((s, v) => s + v, 0), 0);
            const activeLocations = touristData.filter(item => item.data.some(v => v > 0)).length;

            // Find most popular destination
            const topDestination = touristData.reduce((max, item) => {
                const itemTotal = item.data.reduce((sum, val) => sum + val, 0);
                const maxTotal = max.data.reduce((sum, val) => sum + val, 0);
                return itemTotal > maxTotal ? item : max;
            });

            const topTotal = topDestination.data.reduce((sum, val) => sum + val, 0);

            // Calculate average
            const avgVisitors = Math.round(totalVisitors / activeLocations);

            statsDiv.innerHTML = `
                <div class="stat-card">
                    <div class="stat-icon destinations">🏛️</div>
                    <div class="stat-number">${totalLocations}</div>
                    <div class="stat-label">Total Objek Wisata</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon visitors">👥</div>
                    <div class="stat-number">${formatNumber(totalVisitors)}</div>
                    <div class="stat-label">Total Pengunjung</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon reviews">⭐</div>
                    <div class="stat-number">${activeLocations}</div>
                    <div class="stat-label">Lokasi Aktif</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bookings">📊</div>
                    <div class="stat-number">${formatNumber(avgVisitors)}</div>
                    <div class="stat-label">Rata-rata Pengunjung</div>
                </div>
            `;
        }

        function exportToCSV() {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            let csv = 'No,Nama Objek Wisata,Jenis,' + months.join(',') + ',Total\n';

            touristData.forEach((item, index) => {
                const total = item.data.reduce((sum, val) => sum + val, 0);
                csv += `${index + 1},"${item.name}","${item.type}",${item.data.join(',')},${total}\n`;
            });

            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'data_wisata_yogyakarta.csv';
            link.click();
        }

        function exportToExcel() {
            if (typeof XLSX !== 'undefined') {
                const table = document.getElementById('dataTable');
                const wb = XLSX.utils.table_to_book(table);
                XLSX.writeFile(wb, 'data_wisata_yogyakarta.xlsx');
            } else {
                alert('Excel export sedang tidak tersedia. Silakan gunakan CSV export.');
            }
        }

        function copyToClipboard() {
            const table = document.getElementById('dataTable');
            const range = document.createRange();
            range.selectNode(table);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            alert('Data berhasil disalin ke clipboard!');
        }

        // Smooth scrolling for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
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

            // Animate stats on scroll
            const statCards = document.querySelectorAll('.stat-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                    }
                });
            });

            statCards.forEach(card => {
                observer.observe(card);
            });

            // Initialize dashboard
            renderTable();
            renderStats();
        });

        // Add CSS animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
