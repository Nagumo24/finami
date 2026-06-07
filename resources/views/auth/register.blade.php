<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Enkripsi - Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #0c0d0e; color: #ffffff; font-family: 'Segoe UI', Roboto, sans-serif; }
        .card-auth { background-color: #151618; border: 1px solid rgba(204, 255, 0, 0.15); border-radius: 20px; }
        .bg-lime { background-color: #ccff00 !important; color: #000000 !important; }
        .text-lime { color: #ccff00 !important; }
        .form-control-cyber { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; padding: 11px; }
        .form-control-cyber:focus { border-color: #ccff00 !important; box-shadow: 0 0 8px rgba(204, 255, 0, 0.2) !important; background-color: #1f2125 !important; color: white !important; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

<div class="w-100" style="max-width: 400px;">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-lime"><i class="bi bi-shield-plus me-2"></i>Budggt.</h3>
        <p class="text-secondary small">Buat enkripsi akun lokal baru kamu</p>
    </div>

    <div class="card-auth p-4">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="small text-secondary mb-1">Nama Pengguna</label>
                <input type="text" name="name" class="form-control form-control-cyber @error('name') is-invalid @enderror" placeholder="Masukkan nama..." value="{{ old('name') }}" required>
                @error('name') <span class="invalid-feedback small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="small text-secondary mb-1">Alamat Email</label>
                <input type="email" name="email" class="form-control form-control-cyber @error('email') is-invalid @enderror" placeholder="cyber.budgeter@domain.com" value="{{ old('email') }}" required>
                @error('email') <span class="invalid-feedback small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="small text-secondary mb-1">Kata Sandi</label>
                <input type="password" name="password" class="form-control form-control-cyber @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter..." required>
                @error('password') <span class="invalid-feedback small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="small text-secondary mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control form-control-cyber" placeholder="Ulangi kata sandi..." required>
            </div>

            <button type="submit" class="btn bg-lime w-100 py-2.5 rounded-3 fw-bold border-0 mb-3">DAFTAR IDENTITAS</button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-secondary text-decoration-none small">Sudah punya akun? <span class="text-lime">Masuk Sistem</span></a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
