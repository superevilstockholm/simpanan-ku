@extends('App')
@section('title', 'Daftar Siswa - SimpananKu')
@section('content')
    <section class="vh-100 p-0 m-0">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-4 col-md-6 col-12 m-auto">
                    <div class="card bg-transparent"
                        style="backdrop-filter: blur(10px); box-shadow: 0 0 15px rgba(var(--bs-body-color-rgb), 0.1);">
                        <div class="card-body px-4 py-4">
                            <h4 class="text-center p-0 m-0 fw-semibold">Daftar</h4>
                            <p class="text-center p-0 m-0 mb-3" style="font-size: 0.9rem;">Daftar sebagai Siswa</p>
                            <form method="POST" class="mt-2" id="register-form">
                                <div class="form-group mb-2">
                                    <label for="email" class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="dob" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control form-control-sm"
                                        minlength="8" maxlength="128" required>
                                </div>
                                <div class="d-flex flex-column mb-3">
                                    <p class="p-0 m-0" style="font-size: 0.9rem;">Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
                                    <p class="p-0 m-0" style="font-size: 0.9rem;">Kamu seorang guru? <a href="{{ route('teacher_register') }}">Daftar disini</a></p>
                                </div>
                                <button class="btn btn-sm btn-primary w-100" type="submit">Daftar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('register-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            try {
                const response = await axios.post('/api/student-register', {
                    nisn: event.target.nisn.value,
                    dob: event.target.dob.value,
                    email: event.target.email.value,
                    password: event.target.password.value
                });

                if (response.status === 200 && response.data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    window.location.href = '/login';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            } catch (error) {
                if (error.response.status === 400) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: error.response.data.error,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });
    </script>
@endsection
