@extends('layouts.app')

@section('title', 'Keamanan & Pengaturan')

@section('header_action')
    <a href="{{ route('keuangan.profil') }}" class="text-secondary text-decoration-none d-flex align-items-center gap-1 small">
        <i class="bi bi-chevron-left"></i> Kembali
    </a>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold mb-0 fs-2">Keamanan</h1>
        <p class="text-secondary small">Amankan data finansial cyberpunk kamu.</p>
    </div>

    <div class="card-custom p-4 mb-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-shield-lock text-lime me-2"></i> Kunci PIN Aplikasi</h5>

        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Simulasi: PIN Keamanan Berhasil Diperbarui!');">
            <div class="mb-3">
                <label class="small text-secondary mb-1">PIN Lama</label>
                <input type="password" maxlength="6" class="form-control form-control-custom text-center fs-4 font-monospace" placeholder="******" style="letter-spacing: 8px;">
            </div>

            <div class="mb-4">
                <label class="small text-secondary mb-1">PIN Baru (6 Angka)</label>
                <input type="password" maxlength="6" class="form-control form-control-custom text-center fs-4 font-monospace" placeholder="******" style="letter-spacing: 8px;">
            </div>

            <button type="submit" class="btn bg-lime w-100 py-2.5 rounded-3 fw-bold border-0">
                <i class="bi bi-lock-fill me-1"></i> Aktifkan PIN
            </button>
        </form>
    </div>

    <div class="card-custom p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-sliders2-vertical text-lime me-2"></i> Preferensi Sistem</h5>

        <div class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center p-2 card-nested px-3">
                <div>
                    <div class="fw-bold text-white small">Tema Visual</div>
                    <small class="text-secondary" style="font-size: 0.7rem;">Cyberpunk Neon Dark</small>
                </div>
                <span class="badge bg-lime text-dark font-monospace" style="font-size: 0.65rem;">ACTIVE</span>
            </div>

            <div class="d-flex justify-content-between align-items-center p-2 card-nested px-3">
                <div>
                    <div class="fw-bold text-white small">Mode Privasi (Intip)</div>
                    <small class="text-secondary" style="font-size: 0.7rem;">Sembunyikan saldo di halaman utama</small>
                </div>
                <div class="form-check form-switch m-0">
                    <input class="form-check-input" type="checkbox" role="switch" id="privacySwitch" style="cursor: pointer;">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    .form-control-custom { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; }
    .form-control-custom:focus { border-color: #ccff00 !important; box-shadow: 0 0 0 0.25rem rgba(204, 255, 0, 0.25) !important; }
    /* Kustomisasi Switch Warna Hijau Neon */
    .form-check-input:checked { background-color: #ccff00 !important; border-color: #ccff00 !important; }
    .form-check-input { background-color: #2d3035; border-color: #2d3035; }
@endsection
