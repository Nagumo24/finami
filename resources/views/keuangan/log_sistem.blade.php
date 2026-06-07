@extends('layouts.app')

@section('title', 'Log Sistem')

@section('content')
<div class="container py-3" style="margin-bottom: 80px;">
    <div class="d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('keuangan.index') }}" class="text-lime fs-4 text-decoration-none">
            <i class="bi bi-arrow-left-short"></i>
        </a>
        <h4 class="fw-bold text-white mb-0" style="font-size: 1.15rem;">Terminal Monitor Log</h4>
    </div>

    <div class="bg-black border border-secondary border-opacity-50 p-3 rounded-3 font-monospace mb-4" style="box-shadow: 0 0 15px rgba(204, 255, 0, 0.05);">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-2 mb-3" style="font-size: 0.75rem;">
            <div class="text-secondary d-flex gap-1.5 align-items-center">
                <span class="d-inline-block rounded-circle bg-danger" style="width: 8px; height: 8px;"></span>
                <span class="d-inline-block rounded-circle bg-warning" style="width: 8px; height: 8px;"></span>
                <span class="d-inline-block rounded-circle bg-success" style="width: 8px; height: 8px;"></span>
                <span class="ms-2 text-muted">core_kernel_monitor.sh</span>
            </div>
            <span class="text-lime text-opacity-75">STATUS: SECURE</span>
        </div>

        <div class="terminal-body" style="font-size: 0.8rem; line-height: 1.6;">
            <p class="text-secondary mb-1">[SYS_INIT] Menginisialisasi modul enkripsi database...</p>
            <p class="text-lime mb-1">>> User authenticated as: ID-{{ sprintf('%04d', Auth::user()->id) }} // {{ Auth::user()->email }}</p>
            <p class="text-secondary mb-3">[SYS_INFO] Handshake protokol SSL/TLS 1.3 berhasil disinkronkan.</p>

            <h6 class="text-white small fw-bold mb-2 text-uppercase text-lime border-bottom border-secondary border-opacity-25 pb-1">[DATA MUTATION RECORDS]</h6>

            @if($logsKeluaran->isEmpty())
                <p class="text-warning mb-1">>> Warning: Belum ada mutasi record pengeluaran yang terdaftar di basis data.</p>
            @else
                @foreach($logsKeluaran as $log)
                    <p class="text-lime mb-1 m-0">
                        <span class="text-muted">[{{ $log->created_at->format('Y-m-d H:i:s') }}]</span>
                        INSERT -> tabel_pengeluaran [Keperluan: "{{ $log->keperluan }}", Nilai: Rp{{ number_format($log->jumlah, 0, ',', '.') }}] -> <span class="text-info">SUCCESS</span>
                    </p>
                @endforeach
            @endif

            <p class="text-secondary mt-3 mb-1">[SYS_MONITOR] Menunggu interaksi berikutnya dari client stream...</p>
            <p class="text-lime blink mb-0">_</p>
        </div>
    </div>
</div>

<style>
    @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
    .blink { animation: blink 1s infinite; font-weight: bold; }
</style>
@endsection
