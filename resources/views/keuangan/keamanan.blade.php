@extends('layouts.app')

@section('title', 'Keamanan & Profil')

@section('content')
<div class="container py-3" style="margin-bottom: 80px;">
    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('keuangan.index') }}" class="text-lime fs-4 text-decoration-none">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <h4 class="fw-bold text-white mb-0" style="font-size: 1.15rem;">Sistem Keamanan & ID</h4>
    </div>

    @if($errors->any())
        <div class="alert alert-danger bg-dark border-danger text-danger small border-opacity-25 rounded-3 mb-3">
            <ul class="mb-0 ps-3" style="font-size: 0.75rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-custom p-4 border border-secondary border-opacity-25 mb-4" style="border-radius: 16px;">
        <h5 class="fw-bold text-white mb-3 small text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-person-badge text-lime me-2"></i>Perbarui Identitas ID
        </h5>

        <form action="{{ route('keuangan.profil.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="small text-secondary mb-1">Nama Pengguna</label>
                <input type="text" name="name" class="form-control form-control-cyber" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="mb-4">
                <label class="small text-secondary mb-1">Alamat Email Sistem</label>
                <input type="email" name="email" class="form-control form-control-cyber" value="{{ Auth::user()->email }}" required>
            </div>

            <button type="submit" class="btn bg-lime text-black w-100 py-2 rounded-3 fw-bold border-0 small" style="font-size: 0.8rem;">
                <i class="bi bi-save-fill me-1"></i> SIMPAN PERUBAHAN ID
            </button>
        </form>
    </div>

    <div class="card-custom p-4 border border-secondary border-opacity-25" style="border-radius: 16px;">
        <h5 class="fw-bold text-white mb-3 small text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-key text-lime me-2"></i>Perbarui Kunci Akses
        </h5>

        <form action="{{ route('keuangan.keamanan.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="small text-secondary mb-1">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" class="form-control form-control-cyber" placeholder="••••••••" required>
            </div>

            <div class="mb-3">
                <label class="small text-secondary mb-1">Kata Sandi Baru</label>
                <input type="password" name="password" class="form-control form-control-cyber" placeholder="Minimal 6 karakter..." required>
            </div>

            <div class="mb-4">
                <label class="small text-secondary mb-1">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" class="form-control form-control-cyber" placeholder="Ulangi kata sandi baru..." required>
            </div>

            <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold small" style="font-size: 0.8rem; border-color: rgba(220, 53, 69, 0.4);">
                <i class="bi bi-shield-lock-fill me-1"></i> RESET KUNCI ENKRIPSI
            </button>
        </form>
    </div>
</div>

<style>
    .form-control-cyber { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; padding: 11px; font-size: 0.85rem; }
    .form-control-cyber:focus { border-color: #ccff00 !important; box-shadow: 0 0 8px rgba(204, 255, 0, 0.2) !important; background-color: #1f2125 !important; color: white !important; }
</style>
@endsection
