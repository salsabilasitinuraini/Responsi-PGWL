@extends('layout.template')

@section('content')
<style>
    /* Reset dan base styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }

    .hero-section {
        position: relative;
        height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('/storage/images/bg4.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-content {
        text-align: center;
        color: white;
        z-index: 2;
        max-width: 900px;
        padding: 0 20px;
        position: relative;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
        animation: fadeInUp 1s ease-out;
    }

    .hero-subtitle {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        animation: fadeInUp 1s ease-out 0.3s both;
    }

    .hero-description {
        font-size: 1.2rem;
        margin-bottom: 3rem;
        line-height: 1.8;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
        animation: fadeInUp 1s ease-out 0.6s both;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        animation: fadeInUp 1s ease-out 0.9s both;
    }

    .btn-primary {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        color: white;
        padding: 15px 35px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
        border: 2px solid transparent;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(99, 102, 241, 0.4);
        background: linear-gradient(45deg, #8b5cf6, #a855f7);
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: transparent;
        color: white;
        padding: 15px 35px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.8);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        transform: translateY(-3px);
        color: white;
        text-decoration: none;
    }

    /* Features Section - Paling atas */
    .features-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        color: white;
    }

    .section-title {
        text-align: center;
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .section-subtitle {
        text-align: center;
        font-size: 1.3rem;
        margin-bottom: 60px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        opacity: 0.95;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .feature-item {
        text-align: center;
        padding: 30px 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .feature-item:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.15);
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        display: block;
    }

    .feature-item h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .feature-item p {
        font-size: 1rem;
        line-height: 1.6;
        opacity: 0.9;
    }

    /* Video Section */
    .video-section {
        padding: 100px 0;
        background: #f8fafc;
        text-align: center;
    }

    .video-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .video-title {
        color: #6366f1;
        font-size: 2.5rem;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .video-subtitle {
        color: #64748b;
        font-size: 1.2rem;
        margin-bottom: 40px;
    }

    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(99, 102, 241, 0.15);
        background: white;
    }

    .video-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
        border-radius: 20px;
    }

    /* Content Section - Tentang Jejak Temanggung */
    .content-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #e0e7ff 0%, #f1f5f9 50%, #f8fafc 100%);
    }

    .content-section .section-title {
        color: #6366f1;
    }

    .content-section .section-subtitle {
        color: #475569;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 40px 35px;
        text-align: center;
        box-shadow: 0 25px 50px rgba(99, 102, 241, 0.15);
        transition: all 0.4s ease;
        animation: fadeInUp 1s ease-out;
        border: 1px solid rgba(99, 102, 241, 0.1);
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
    }

    .info-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 35px 70px rgba(99, 102, 241, 0.25);
        background: rgba(255, 255, 255, 1);
    }

    .info-card-icon {
        font-size: 3.5rem;
        margin-bottom: 25px;
        display: block;
    }

    .info-card h3 {
        color: #6366f1;
        font-size: 1.8rem;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .info-card p {
        color: #4A5568;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .info-card .highlight {
        color: #8b5cf6;
        font-weight: 700;
    }

    /* Social Links */
    .social-section {
        padding: 80px 0;
        background: linear-gradient(45deg, #4c1d95, #6366f1);
        text-align: center;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        color: white;
        text-decoration: none;
        padding: 18px 30px;
        border-radius: 50px;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 1.1rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .social-link:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    /* Footer */
    .footer {
        background: #312e81;
        color: white;
        text-align: center;
        padding: 50px 0;
    }

    .footer p {
        margin: 0;
        opacity: 0.9;
        font-size: 1.1rem;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.8rem;
        }

        .hero-subtitle {
            font-size: 1.4rem;
        }

        .hero-description {
            font-size: 1.1rem;
        }

        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn-primary, .btn-secondary {
            width: 100%;
            max-width: 300px;
        }

        .info-cards {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .social-links {
            flex-direction: column;
            align-items: center;
        }

        .social-link {
            width: 100%;
            max-width: 300px;
        }

        .section-title {
            font-size: 2.2rem;
        }
    }

    /* Decorative elements */
    .hero-section::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0.3), rgba(139, 92, 246, 0.3));
        clip-path: polygon(0 100%, 100% 100%, 100% 0, 0 80%);
        z-index: 1;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title floating">Jejak Temanggung</h1>
        <p class="hero-subtitle">Jelajahi Keindahan Wisata Kabupaten Temanggung</p>
        <p class="hero-description">
            Temukan pesona tersembunyi Temanggung melalui peta interaktif yang menampilkan berbagai destinasi wisata menarik,
            dari keindahan alam pegunungan hingga kekayaan budaya lokal yang memukau.
        </p>
        <div class="hero-buttons">
            <a href="#explore" class="btn-primary">🗺️ Fitur Unggulan</a>
            <a href="#about" class="btn-secondary">📖 Tentang Website</a>
        </div>
    </div>
</section>

<!-- Features Section - PERTAMA -->
<section class="features-section" id="explore">
    <div class="section-title">Fitur Unggulan</div>
    <div class="section-subtitle">Nikmati pengalaman eksplorasi wisata yang tak terlupakan</div>

    <div class="features-grid">
        <div class="feature-item">
            <span class="feature-icon">🗺️</span>
            <h3>Peta Interaktif</h3>
            <p>Jelajahi lokasi wisata dengan peta interaktif yang mudah digunakan dan informatif</p>
        </div>

        <div class="feature-item">
            <span class="feature-icon">📍</span>
            <h3>Lokasi Akurat</h3>
            <p>Temukan lokasi wisata dengan koordinat yang tepat</p>
        </div>

        <div class="feature-item">
            <span class="feature-icon">📸</span>
            <h3>Galeri Foto</h3>
            <p>Lihat koleksi foto menarik dari setiap destinasi wisata sebelum berkunjung</p>
        </div>

        <div class="feature-item">
            <span class="feature-icon">ℹ️</span>
            <h3>Informasi Lengkap</h3>
            <p>Dapatkan informasi detail tentang fasilitas, jam operasional, dan tips berkunjung</p>
        </div>

        <div class="feature-item">
            <span class="feature-icon">🌟</span>
            <h3>Rekomendasi</h3>
            <p>Temukan rekomendasi wisata terbaik berdasarkan preferensi Anda</p>
        </div>

        <div class="feature-item">
            <span class="feature-icon">📱</span>
            <h3>Mobile Friendly</h3>
            <p>Akses website dengan mudah melalui smartphone untuk pengalaman optimal</p>
        </div>
    </div>
</section>

<!-- Video Section - KEDUA -->
<section class="video-section">
    <div class="video-container">
        <h2 class="video-title">Selayang Pandang</h2>
        <p class="video-subtitle">Tonton video pengenalan tentang keindahan dan keberagaman Kabupaten Temanggung</p>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/mlDZGZVdk4U?si=XgOQ8dJFfkEMWi9-"
                    title="Video Pengenalan Jejak Temanggung"
                    allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<!-- Content Section - KETIGA (Tentang Jejak Temanggung) -->
<section class="content-section" id="about">
    <div class="section-title">Tentang Jejak Temanggung</div>
    <div class="section-subtitle">Platform digital untuk mengeksplorasi kekayaan wisata Kabupaten Temanggung</div>

    <div class="info-cards">
        <!-- Student Info Card -->
        <div class="info-card">
            <span class="info-card-icon">🎓</span>
            <h3>Informasi Mahasiswa</h3>
            <p><span class="highlight">Nama:</span> Salsabila Siti Nur Aini</p>
            <p><span class="highlight">NIM:</span> 23/521480/SV/23444</p>
            <p><span class="highlight">Kelas:</span> B</p>
            <p><span class="highlight">Program:</span> Praktikum Pemrograman Geospasial Web Lanjut</p>
        </div>

        <!-- Course Info Card -->
        <div class="info-card">
            <span class="info-card-icon">🌍</span>
            <h3>Tentang Proyek</h3>
            <p>Website Jejak Temanggung merupakan platform digital yang dikembangkan untuk memudahkan wisatawan dalam mengeksplorasi berbagai destinasi wisata di Kabupaten Temanggung.</p>
            <p>Menggabungkan teknologi geospasial modern dengan informasi wisata yang komprehensif.</p>
        </div>

        <!-- Technology Stack Card -->
        <div class="info-card">
            <span class="info-card-icon">💻</span>
            <h3>Teknologi yang Digunakan</h3>
            <p><span class="highlight">Backend:</span> Laravel Framework</p>
            <p><span class="highlight">Frontend:</span> HTML5, CSS3, JavaScript</p>
            <p><span class="highlight">Mapping:</span> Leaflet, OpenLayers</p>
            <p><span class="highlight">Database:</span> PostgreSQL dengan PostGIS</p>
        </div>
    </div>
</section>

<!-- Social Links Section -->
<section class="social-section">
    <div class="container">
        <h2 style="color: white; margin-bottom: 20px; font-size: 2.5rem; font-weight: 700;">Hubungi Saya</h2>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 0;">Mari terhubung dan berbagi pengalaman wisata!</p>
        <div class="social-links">
            <a href="https://instagram.com/salsabilasna_" class="social-link" target="_blank">
                📷 Instagram
            </a>
            <a href="https://github.com/salsabilasitinuraini" class="social-link" target="_blank">
                💻 GitHub
            </a>
            <a href="mailto:salsabilasitinuraini@mail.ugm.ac.id" class="social-link">
                ✉️ Email
            </a>
            <a href="https://www.linkedin.com/in/salsabila-siti-nur-aini-42b919307?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="social-link" target="_blank">
                💼 LinkedIn
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>© 2025 Jejak Temanggung - Created by Salsabila Siti Nur Aini • Praktikum Pemrograman Geospasial Web Lanjut</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling untuk navigasi
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

        // Parallax effect untuk hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroContent = document.querySelector('.hero-content');
            if (heroContent && scrolled < window.innerHeight) {
                heroContent.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });

        // Animasi card saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe semua cards
        document.querySelectorAll('.info-card, .feature-item').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Animasi typing untuk hero title
        const heroTitle = document.querySelector('.hero-title');
        if (heroTitle) {
            const text = heroTitle.textContent;
            heroTitle.textContent = '';
            let i = 0;

            setTimeout(() => {
                const typeInterval = setInterval(() => {
                    heroTitle.textContent += text.charAt(i);
                    i++;
                    if (i >= text.length) {
                        clearInterval(typeInterval);
                    }
                }, 100);
            }, 500);
        }

        // Hover effect untuk social links
        document.querySelectorAll('.social-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.05)';
            });

            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-5px) scale(1)';
            });
        });
    });
</script>
@endsection
