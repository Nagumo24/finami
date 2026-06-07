<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Enkripsi - Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #0c0d0e; color: #ffffff; font-family: 'Segoe UI', Roboto, sans-serif; }
        .card-auth { background-color: #151618; border: 1px solid rgba(204, 255, 0, 0.15); border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.5); }
        .bg-lime { background-color: #ccff00 !important; color: #000000 !important; }
        .text-lime { color: #ccff00 !important; }
        .form-control-cyber { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; padding: 12px; }
        .form-control-cyber:focus { border-color: #ccff00 !important; box-shadow: 0 0 8px rgba(204, 255, 0, 0.2) !important; background-color: #1f2125 !important; color: white !important; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

<div class="w-100" style="max-width: 400px;">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-lime"><i class="bi bi-terminal-fill me-2"></i>Budggt.</h3>
        <p class="text-secondary small">Masukkan otentikasi kunci untuk membuka dasbor finansial</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-dark border-success text-success small border-opacity-25 rounded-3 mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-auth p-4">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="small text-secondary mb-1">Alamat Email</label>
                <input type="email" name="email" class="form-control form-control-cyber @error('email') is-invalid @enderror" placeholder="nama@domain.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="small text-secondary mb-1">Kata Sandi (Password)</label>
                <input type="password" name="password" class="form-control form-control-cyber" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn bg-lime w-100 py-2.5 rounded-3 fw-bold border-0 mb-3">OTENTIKASI MASUK</button>

            <div class="text-center">
                <a href="{{ route('register') }}" class="text-secondary text-decoration-none small">Belum punya akun? <span class="text-lime">Registrasi ID Baru</span></a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
