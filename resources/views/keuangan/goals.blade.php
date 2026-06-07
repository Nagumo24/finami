@extends('layouts.app')

@section('title', 'Target Finansial')

@section('content')
<div class="container py-3">
    <!-- Header Target -->
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h2 class="fw-bold text-white mb-0">Target Finansial</h2>
        <button class="btn bg-lime text-black btn-sm fw-bold px-3 py-1.5 rounded-pill border-0" data-bs-toggle="modal" data-bs-target="#modalTambahTarget">
            <i class="bi bi-plus-lg me-1"></i> Tambah Target
        </button>
    </div>
    <p class="text-secondary small mb-4">Wujudkan impianmu selangkah demi selangkah.</p>

    <!-- DAFTAR TARGET IMPIAN -->
    <div class="d-flex flex-column gap-3">
        @forelse($goals as $goal)
            @php
                $persen = $goal->nominal_target > 0 ? round(($goal->nominal_terkumpul / $goal->nominal_target) * 100) : 0;
                $persen = $persen > 100 ? 100 : $persen;
            @endphp

            <div class="card-custom p-4 border border-secondary border-opacity-25" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h5 class="fw-bold text-white mb-0 text-uppercase" style="letter-spacing: 0.5px;">{{ $goal->nama_target }}</h5>
                        <small class="text-secondary" style="font-size: 0.7rem;">
                            <i class="bi bi-calendar-event me-1"></i> Tenggat: {{ $goal->tenggat_waktu ? \Carbon\Carbon::parse($goal->tenggat_waktu)->format('d M Y') : '-' }}
                        </small>
                    </div>

                    <!-- Tombol Hapus Target -->
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Hapus target ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-secondary p-0 border-0"><i class="bi bi-trash fs-5 hover-danger"></i></button>
                    </form>
                </div>

                <!-- Informasi Nominal & Tombol Aksi Menabung -->
                <div class="d-flex justify-content-between align-items-end small mb-2 mt-3">
                    <div>
                        <div class="text-secondary" style="font-size: 0.75rem;">Terkumpul:</div>
                        <div class="fs-5 fw-bold text-lime">
                            Rp{{ number_format($goal->nominal_terkumpul, 0, ',', '.') }}
                            <!-- TOMBOL UNTUK ISI SALDO KE GOAL INI -->
                            <button class="btn btn-sm btn-nested ms-1.5 px-2 py-0.5 rounded text-lime border-0" data-bs-toggle="modal" data-bs-target="#modalIsiTabungan{{ $goal->id }}" style="font-size: 0.75rem; background-color: rgba(204, 255, 0, 0.1);">
                                <i class="bi bi-plus-circle-fill me-1"></i>Isi Uang
                            </button>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-secondary" style="font-size: 0.75rem;">Target:</div>
                        <div class="fw-bold text-white">Rp{{ number_format($goal->nominal_target, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="progress card-nested p-0 mb-1" style="height: 8px; background-color: #1f2125; border-radius: 20px;">
                    <div class="progress-bar bg-lime rounded-pill" role="progressbar" style="width: {{ $persen }}%;" aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="text-end text-lime small fw-bold" style="font-size: 0.7rem;">{{ $persen }}% Tercapai</div>
            </div>

            <!-- MODAL DINAMIS UNTUK MASING-MASING GOAL (ISI TABUNGAN) -->
            <div class="modal fade" id="modalIsiTabungan{{ $goal->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content card-custom p-2 border-secondary border-opacity-50">
                        <div class="modal-header border-0">
                            <h6 class="modal-title fw-bold text-white"><i class="bi bi-wallet2 text-lime me-2"></i>Isi Celengan Target</h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-2">
                            <form action="{{ route('goals.tambahTabungan', $goal->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Target: <span class="text-white fw-bold">{{ $goal->nama_target }}</span></label>
                                    <input type="number" name="jumlah_tabungan" class="form-control form-control-custom" placeholder="Masukkan nominal uang..." min="1" required>
                                </div>
                                <button type="submit" class="btn bg-lime w-100 py-2 rounded-3 fw-bold text-black border-0 small">Masukkan ke Celengan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="card-custom p-5 text-center border border-secondary border-opacity-25" style="border-radius: 16px;">
                <div class="text-secondary display-6 mb-2"><i class="bi bi-wallet2"></i></div>
                <p class="text-secondary small mb-0">Belum ada target impian finansial yang tercatat.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- MODAL UNTUK INPUT TARGET BARU -->
<div class="modal fade" id="modalTambahTarget" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-custom p-2 border-secondary border-opacity-50">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-white"><i class="bi bi-trophy text-lime me-2"></i>Buat Target Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('goals.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small text-secondary mb-1">Nama Target Impian</label>
                        <input type="text" name="nama_target" class="form-control form-control-custom" placeholder="Contoh: Sepatu Kerja Baru, Tabungan PC" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-secondary mb-1">Nominal Target (Rp)</label>
                        <input type="number" name="nominal_target" class="form-control form-control-custom" placeholder="Contoh: 1500000" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-secondary mb-1">Saldo Awal Disisihkan (Optional)</label>
                        <input type="number" name="nominal_terkumpul" class="form-control form-control-custom" placeholder="Contoh: 0" min="0">
                    </div>
                    <div class="mb-4">
                        <label class="small text-secondary mb-1">Tenggat Waktu / Target Dicapai</label>
                        <input type="date" name="tenggat_waktu" class="form-control form-control-custom">
                    </div>
                    <button type="submit" class="btn bg-lime w-100 py-2 rounded-3 fw-bold text-black border-0">Simpan Target</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    .bg-lime { background-color: #ccff00 !important; }
    .text-lime { color: #ccff00 !important; }
    .form-control-custom { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; }
    .btn-nested { background-color: #1f2125; transition: 0.2s; }
    .btn-nested:hover { background-color: #ccff00 !important; color: #000000 !important; }
    .hover-danger:hover { color: #dc3545 !important; transition: 0.2s; }
@endsection
