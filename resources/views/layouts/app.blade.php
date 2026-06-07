<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budggt - @yield('title', 'Personal Finance')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { background-color: #000000; color: #ffffff; font-family: 'Segoe UI', sans-serif; padding-bottom: 120px; }
        .text-lime { color: #ccff00; }
        .bg-lime { background-color: #ccff00; color: #000000; }
        .bg-lime:hover { background-color: #b3e600; color: #000000; }
        .card-custom { background-color: #161719; border: 1px solid #24262b; border-radius: 24px; }
        .card-nested { background-color: #1f2125; border: 1px solid #2d3035; border-radius: 16px; }

        /* Navigasi Bawah */
        .bottom-nav {
            background-color: #161719; border: 1px solid #24262b; border-radius: 20px;
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; max-width: 500px; z-index: 1050;
        }
        .nav-btn-center {
            width: 60px; height: 60px; border-radius: 50%; background-color: #ccff00; color: #000000;
            display: flex; align-items: center; justify-content: center; font-size: 24px;
            margin-top: -30px; border: 5px solid #000000; box-shadow: 0 4px 15px rgba(204, 255, 0, 0.4);
            text-decoration: none;
        }

        /* Transaksi & Balances tambahan untuk Arus Kas */
        .badge-pemasukan { background-color: rgba(204, 255, 0, 0.1); color: #ccff00; border: 1px solid rgba(204, 255, 0, 0.2); }
        .badge-pengeluaran { background-color: rgba(255, 7, 58, 0.1); color: #ff073a; border: 1px solid rgba(255, 7, 58, 0.2); }
        .text-danger-neon { color: #ff073a; }

        @yield('styles')
    </style>
</head>
<body>

<div class="container pt-4 px-4" style="max-width: 600px;">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-lime text-dark border-0 rounded-4 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-lime fs-5 px-2.5 py-1 font-bold">B.</span>
            <span class="fs-4 fw-bold">Budggt.</span>
        </div>
        <div>
            @yield('header_action')
        </div>
    </div>

    @yield('content')

</div>

<div class="bottom-nav d-flex justify-content-around align-items-center py-3">
   <!-- Tombol Menu Dashboard Utama -->
    <a href="{{ route('keuangan.index') }}" class="{{ Route::is('keuangan.index') ? 'text-lime' : 'text-secondary' }} fs-4">
        <i class="{{ Route::is('keuangan.index') ? 'bi bi-grid-1x2-fill' : 'bi bi-grid-1x2' }}"></i>
    </a>

    <a href="{{ route('goals.index') }}" class="{{ Route::is('goals.index') ? 'text-lime' : 'text-secondary' }} fs-4">
        <i class="{{ Route::is('goals.index') ? 'bi bi-wallet2' : 'bi bi-wallet2' }}"></i>
    </a>

    <a href="{{ route('keuangan.index') }}" class="nav-btn-center">
        <i class="bi bi-plus-lg"></i>
    </a>

    <a href="{{ route('keuangan.arus-kas') }}" class="{{ Route::is('keuangan.arus-kas') ? 'text-lime' : 'text-secondary' }} fs-4">
        <i class="bi bi-arrow-left-right"></i>
    </a>

    <a href="{{ route('keuangan.profil') }}" class="{{ Route::is('keuangan.profil') ? 'text-lime' : 'text-secondary' }} fs-4">
        <i class="{{ Route::is('keuangan.profil') ? 'bi bi-person-fill' : 'bi bi-person' }}"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
