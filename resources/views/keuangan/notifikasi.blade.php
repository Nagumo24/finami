@extends('layouts.app')

@section('title', 'Notifikasi Sistem')

@section('content')
<div class="container py-3">
    <div class="d-flex align-items-center gap-2 mb-2">
        <a href="{{ route('keuangan.index') }}" class="text-secondary text-decoration-none small">
            <i class="bi bi-chevron-left"></i> Kembali
        </a>
    </div>
    <h2 class="fw-bold text-white mb-1">Notifikasi</h2>
    <p class="text-secondary small mb-4">Pemberitahuan otomatis dari sistem mesin *Budggt*.</p>

    <div class="d-flex flex-column gap-3">

        @if(isset($totalRunway) && $totalRunway < 1.0)
            <div class="card-custom p-3 border border-danger border-opacity-50" style="background-color: rgba(220, 53, 69, 0.05); border-radius: 16px;">
                <div class="d-flex gap-3 align-items-start">
                    <div class="text-danger fs-4"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold text-danger mb-1">Sistem Finansial Kritis!</h6>
                            <small class="text-secondary" style="font-size: 0.7rem;">Baru Saja</small>
                        </div>
                        <p class="text-secondary small mb-0">Total Runway kamu saat ini tinggal {{ $totalRunway }} bulan. Segera pangkas pengeluaran non-wajib!</p>
                    </div>
                </div>
            </div>
        @endif

        @forelse($notifikasiTransaksi as $notif)
            @if($notif['tipe'] == 'pemasukan')
                <div class="card-custom p-3 border border-success border-opacity-25" style="border-radius: 16px;">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="text-lime fs-4"><i class="bi bi-arrow-down-left-circle-fill"></i></div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold text-white small mb-1">{{ $notif['judul'] }}</h6>
                                <small class="text-secondary" style="font-size: 0.65rem;">
                                    {{ \Carbon\Carbon::parse($notif['waktu'])->diffForHumans() }}
                                </small>
                            </div>
                            <p class="text-secondary small mb-0" style="font-size: 0.75rem;">{{ $notif['pesan'] }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-custom p-3 border border-danger border-opacity-25" style="border-radius: 16px;">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="text-danger fs-4"><i class="bi bi-arrow-up-right-circle-fill"></i></div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold text-white small mb-1">{{ $notif['judul'] }}</h6>
                                <small class="text-secondary" style="font-size: 0.65rem;">
                                    {{ \Carbon\Carbon::parse($notif['waktu'])->diffForHumans() }}
                                </small>
                            </div>
                            <p class="text-secondary small mb-0" style="font-size: 0.75rem;">{{ $notif['pesan'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center card-custom p-5 text-secondary small">
                <i class="bi bi-bell-slash fs-2 mb-2 d-block"></i>
                Belum ada notifikasi aktivitas transaksi masuk atau keluar.
            </div>
        @endforelse

    </div>
</div>
@endsection
