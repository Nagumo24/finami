@extends('layouts.app')

@section('title', 'Laporan Arus Kas')

@section('header_action')
    <i class="bi bi-filter-left fs-4 text-secondary"></i>
@endsection

@section('content')
    <!-- Judul Section -->
    <div class="mb-4">
        <h1 class="fw-bold mb-0 fs-2">Arus Kas</h1>
        <p class="text-secondary small">Semua mutasi finansial terpantau di sini.</p>
    </div>

    <!-- DAFTAR TRANSAKSI GABUNGAN -->
    <div class="d-flex flex-column gap-3">
        @forelse($semuaTransaksi as $transaksi)
            <div class="card-custom p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="card-nested p-2.5 rounded-4 d-flex align-items-center justify-content-center">
                            @if($transaksi->tipe == 'pemasukan')
                                <i class="bi bi-arrow-down-left-circle-fill text-lime fs-4"></i>
                            @else
                                <i class="bi bi-arrow-up-right-circle-fill text-danger-neon fs-4"></i>
                            @endif
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-white">{{ $transaksi->keterangan ?? 'Tanpa Keterangan' }}</h6>
                            <small class="text-secondary" style="font-size: 0.75rem;">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}
                            </small>
                        </div>
                    </div>
                    <div class="text-end">
                        @if($transaksi->tipe == 'pemasukan')
                            <span class="fw-bold text-lime">+Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</span>
                            <span class="badge badge-pemasukan d-block small mt-1" style="font-size: 0.65rem;">Masuk</span>
                        @else
                            <span class="fw-bold text-danger-neon">-Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</span>
                            <span class="badge badge-pengeluaran d-block small mt-1" style="font-size: 0.65rem;">Keluar</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="card-custom p-5 text-center text-secondary">
                <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                Belum ada catatan transaksi masuk atau keluar.
            </div>
        @endforelse
    </div>
@endsection
