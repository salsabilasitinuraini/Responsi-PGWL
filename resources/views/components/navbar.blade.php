<nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-lg">
    <div class="container-fluid">
        <!-- Brand with icon -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <i class="fas fa-globe-americas me-2 text-warning"></i>
            <span class="brand-text">{{ $title }}</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}"
                       aria-current="page" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>
                        <span class="nav-text">Home</span>
                    </a>
                </li>



                <!-- Map -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('map') ? 'active' : '' }}"
                       href="{{ route('map') }}">
                        <i class="fas fa-map-location-dot me-1"></i>
                        <span class="nav-text">Peta</span>
                    </a>
                </li>

                <!-- Table -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('table') ? 'active' : '' }}"
                       href="{{ route('table') }}">
                        <i class="fas fa-table me-1"></i>
                        <span class="nav-text">Table</span>
                    </a>
                </li>

                <!-- Dashboard (only for authenticated users) -->
                @auth
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                @endauth

                <!-- Data Dropdown (only for authenticated users) -->
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-custom
                        {{ request()->routeIs('api.points') || request()->routeIs('api.polylines') || request()->routeIs('api.polygons') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-database me-1"></i>
                        <span class="nav-text">Data</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                        <li>
                            <a class="dropdown-item custom-dropdown-item"
                               href="{{ route('api.points') }}" target="_blank">
                                <i class="fas fa-map-pin me-2 text-primary"></i>Points
                            </a>
                        </li>
                        {{--
    <li>
        <a class="dropdown-item custom-dropdown-item"
           href="{{ route('api.polylines') }}" target="_blank">
            <i class="fas fa-route me-2 text-success"></i>Polylines
        </a>
    </li>
    <li>
        <a class="dropdown-item custom-dropdown-item"
           href="{{ route('api.polygons') }}" target="_blank">
            <i class="fas fa-draw-polygon me-2 text-warning"></i>Polygons
        </a>
    </li>
--}}

                    </ul>
                </li>

                <!-- User Profile/Logout -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-custom"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <li><hr class="dropdown-divider"></li>
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

                <!-- Login (only for guests) -->
                @guest
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light custom-login-btn"
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

<!-- Custom CSS untuk navbar dengan kontras yang jelas -->
<style>
/* Navbar Background - Warna Gelap untuk Kontras */
.custom-navbar {
    background: linear-gradient(135deg, #1e3a8a 0%, #7c2d12 100%) !important;
    padding: 1rem 0;
    border-bottom: 3px solid #fbbf24;
}

/* Brand Styling */
.navbar-brand {
    font-size: 1.6rem !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.brand-text {
    color: #ffffff !important;
}

/* Nav Links - Putih dengan Background Gelap */
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
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.nav-link-custom.active {
    background-color: #fbbf24 !important;
    color: #1e3a8a !important;
    font-weight: 700 !important;
}

/* Dropdown Styling */
.custom-dropdown {
    background-color: #ffffff !important;
    border: none !important;
    border-radius: 15px !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
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

/* Login Button */
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

/* Mobile Toggle Button */
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

/* Shadow untuk navbar */
.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
}

/* Responsive */
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

/* Animasi untuk smooth transitions */
* {
    transition: all 0.3s ease;
}
</style>
