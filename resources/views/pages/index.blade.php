@extends('App')
@section('title', 'SimpananKu')
@section('content')
<section class="hero-section-index py-3 py-md-0">
    <div class="container h-100">
        <div class="row flex-md-row-reverse h-100 align-items-md-center">
            <div class="col-md-6 col-12 mb-2 mb-md-0">
                <div class="pe-lg-5 pe-md-3 ps-md-0">
                    <img class="img-fluid object-fit-cover rounded-3" src="https://placehold.co/600x400/EEE/31343C" alt="Hero Section Image: Preview tampilan dashboard siswa.">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="ps-lg-5 ps-md-3 pe-md-0 h-100 d-flex flex-column justify-content-md-center">
                    <h1 class="display-4 fw-semibold">SimpananKu</h1>
                    <p>SimpananKu adalah aplikasi berbasis website untuk membantu dan mempermudah guru dan siswa dalam mengelola tabungan siswa.</p>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('student_register') }}" class="btn btn-sm btn-primary px-3 d-flex align-items-center gap-2">Mulai <i class="bi bi-arrow-right"></i></a>
                        <a href="{{ route('features') }}" class="btn btn-sm btn-outline-primary px-3 d-flex align-items-center gap-2">Lihat Fitur <i class="bi bi-book"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 my-lg-5 my-md-3 my-0">
    <div class="container">
        <h3 class="text-center fw-semibold display-6 mb-5">Mengapa memilih SimpananKu</h3>
        <div class="row">
            <div class="col-md-4 col-6 mx-auto">
                <div class="d-flex flex-column align-items-center text-center gap-3">
                    <i class="bi bi-check-circle-fill display-5 text-primary"></i>
                    <h5>Aman & Terpercaya</h5>
                </div>
            </div>
            <div class="col-md-4 col-6 mx-auto">
                <div class="d-flex flex-column align-items-center text-center gap-3">
                    <i class="bi bi-lightning-charge-fill display-5 text-primary"></i>
                    <h5>Cepat & Mudah</h5>
                </div>
            </div>
            <div class="col-md-4 col-6 mx-auto mt-md-0 mt-3">
                <div class="d-flex flex-column align-items-center text-center gap-3">
                    <i class="bi bi-clock display-5 text-primary"></i>
                    <h5>24/7 Akses</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    @media (min-width: 768px) {
        .hero-section-index {
            height: 400px !important;
        }
    }
    @media (min-width: 992px) {
        .hero-section-index {
            height: 573px !important;
        }
    }
</style>
@endsection
