@extends('App')
@section('title', 'SimpananKu')
@section('content')
<section class="py-md-5 py-3">
    <div class="container">
        <div class="row flex-md-row-reverse">
            <div class="col-md-6 col-12 mb-2 mb-md-0">
                <div class="pe-lg-5 pe-md-3 ps-md-0 px-3">
                    <img class="img-fluid object-fit-cover rounded-3" style="max-height: 300px;" src="https://placehold.co/600x400/EEE/31343C" alt="Hero Section Image: Preview tampilan dashboard siswa.">
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
@endsection
