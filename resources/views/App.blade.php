<!DOCTYPE html>
<html lang="id">
<head>
    {{-- SEO --}}
    <meta name="description" content="@yield('description', 'SimpananKu - Aplikasi Tabungan Digital Sekolah')">
    <meta name="keywords" content="@yield('keywords', 'simpanan, tabungan digital, siswa, sekolah, simpananku')">
    <meta name="author" content="AmbaToCode">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SimpananKu')</title>
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    {{-- Styles --}}
    <style>
        /* Default font is inter */
        * { font-family: 'Inter', Helvetica, sans-serif; }
    </style>
</head>
<body data-bs-theme="dark">
    @include('components.navbar_component')
    <main>
        @yield('content')
    </main>
    @include('components.footer_component')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>
