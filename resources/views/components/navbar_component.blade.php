<nav class="navbar navbar-expand-md sticky-top" style="backdrop-filter: blur(10px);">
    <div class="container">
        <div class="w-md-25 d-flex align-items-center justify-content-start">
            <a class="navbar-brand fw-semibold d-flex align-items-center" href="{{ route('index') }}">Simpanan <span class="text-primary">Ku</span></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-md-50" id="navbarNav">
            <ul class="navbar-nav mx-md-auto gap-2" style="font-size: 0.9rem;">
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('index') ? ' active': '' }}" {{ request()->routeIs('index') ? 'aria-current="page"': '' }} href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('features') ? ' active': '' }}" {{ request()->routeIs('features') ? 'aria-current="page"': '' }} href="{{ route('features') }}">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->routeIs('testimonials') ? ' active': '' }}" {{ request()->routeIs('testimonials') ? 'aria-current="page"': '' }} href="{{ route('testimonials') }}">Testimoni</a>
                </li>
                <li class="nav-item d-md-none">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="login-btn btn btn-sm py-0 ps-0 pe-2 rounded-0 border-end" style="font-size: 0.9rem;">Masuk</a>
                        <a href="{{ route('student_register') }}" class="btn btn-sm btn-outline-primary px-2" style="font-size: 0.9rem;">Daftar</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="w-md-25 d-none d-md-flex justify-content-end">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="login-btn btn btn-sm py-0 px-2 rounded-0 border-end">Masuk</a>
                <a href="{{ route('student_register') }}" class="btn btn-sm btn-outline-primary px-2">Daftar</a>
            </div>
        </div>
    </div>
</nav>
<style>
    @media (min-width: 768px) {
        .w-md-100 {
            width: 100% !important;
        }
        .w-md-75 {
            widows: 75% !important;
        }
        .w-md-50 {
            width: 50% !important;
        }
        .w-md-25 {
            width: 25% !important;
        }
    }
    .login-btn:hover, .login-btn:focus {
        background-color: transparent !important;
        border-top-color: transparent !important;
        border-left-color: transparent !important;
        border-bottom-color: transparent !important;
        color: rgba(var(--bs-body-color-rgb), 0.8);
    }
</style>
