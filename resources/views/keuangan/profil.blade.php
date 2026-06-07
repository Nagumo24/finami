@extends('layouts.app')

@section('title', 'Profil & Pengaturan')

@section('content')
<div class="container py-3" style="margin-bottom: 80px;">
    <!-- Header Menu -->
    <div class="mb-1">
        <h2 class="fw-bold text-white mb-0">Profil Pengguna</h2>
        <p class="text-secondary small mb-4">Kelola parameter dan kontrol sistem keuanganmu.</p>
    </div>

    <!-- KARTU UTAMA PROFIL -->
    <div class="card-custom p-4 text-center border border-secondary border-opacity-25 mb-3" style="border-radius: 16px;">
        <div class="d-flex justify-content-center mb-3">
            <div class="rounded-circle bg-lime d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                <i class="bi bi-person-fill text-black fs-2"></i>
            </div>
        </div>
        <!-- Nama & Email Statis Cyberpunk -->
        <!-- Cari baris ini di profil.blade.php dan ubah menjadi dinamis -->
        <h4 class="fw-bold text-white mb-1">{{ Auth::user()->name }}</h4>
        <p class="text-secondary small mb-3">{{ Auth::user()->email }}</p>

        <!-- BADGE STATUS DINAMIS -->
        <span class="badge border border-success border-opacity-50 text-success bg-dark px-3 py-2 rounded-pill small fw-bold" style="letter-spacing: 0.5px; font-size: 0.7rem;">
            <i class="bi bi-shield-check me-1"></i> STATUS: AKTIF
        </span>
    </div>

    <!-- KARTU KONTROL SISTEM (PENGGANTI FORM LAMA) -->
    <div class="card-custom p-4 border border-secondary border-opacity-25 mb-3" style="border-radius: 16px;">
        <h5 class="fw-bold text-white mb-3 small text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-cpu text-lime me-2"></i>Kontrol Inti Sistem
        </h5>
        <p class="text-secondary" style="font-size: 0.75rem;">
            Gunakan opsi di bawah ini untuk memanipulasi atau membersihkan database transaksi lokal kamu secara permanen.
        </p>

        <!-- FITUR FORMAT DATABASE -->
        <div class="card-nested p-3 border border-secondary border-opacity-25 rounded-3 mb-2" style="background-color: #1f2125;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold text-white small">Format Riwayat Finansial</div>
                    <div class="text-secondary" style="font-size: 0.7rem;">Menghapus seluruh catatan pemasukan dan pengeluaran kamu dari awal.</div>
                </div>
                <form action="{{ route('profil.resetData') }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN: Semua riwayat tabungan dan pengeluaran akan dihapus total! Anda yakin?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger fw-bold rounded-3 px-3 py-1.5" style="font-size: 0.75rem;">
                        <i class="bi bi-trash3-fill me-1"></i> Reset Data
                    </button>
                </form>
            </div>
        </div>
    </div>

        <!-- TOMBOL NAVIGASI TAMBAHAN -->
        <!-- SEBELUMNYA: <div class="card-custom p-3 ..."> -->
    <!-- UBAH MENJADI: -->
    <a href="{{ route('keuangan.keamanan') }}" class="card-custom p-3 border border-secondary border-opacity-25 d-flex justify-content-between align-items-center mb-2 text-decoration-none" style="border-radius: 12px; cursor: pointer;">
        <div class="d-flex align-items-center gap-3">
            <div class="text-secondary"><i class="bi bi-shield-lock fs-5"></i></div>
            <div class="fw-bold text-white small">Keamanan & PIN Akun</div>
        </div>
        <div class="text-secondary"><i class="bi bi-chevron-right"></i></div>
    </a>

    <a href="{{ route('keuangan.log') }}" class="card-custom p-3 border border-secondary border-opacity-25 d-flex justify-content-between align-items-center mb-2 text-decoration-none" style="border-radius: 12px; cursor: pointer;">
        <div class="d-flex align-items-center gap-3">
            <div class="text-secondary"><i class="bi bi-info-circle fs-5"></i></div>
            <div class="fw-bold text-white small">Log Sistem & Enkripsi</div>
        </div>
        <div class="text-secondary"><i class="bi bi-chevron-right"></i></div>
    </a>

    <!-- Tambahkan ini di bagian bawah profil.blade.php sebelum -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold small">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar / Kunci Aplikasi
            </button>
        </form>
</div>
@endsection
