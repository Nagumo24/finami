@extends('layouts.app')

@section('title', 'Dashboard Finansial')

@section('header_action')
    <a href="{{ route('keuangan.notifikasi') }}" class="text-secondary position-relative">
        <i class="bi bi-bell fs-5"></i>
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-lime border border-black rounded-circle"></span>
    </a>
@endsection

@section('content')
    <div class="card-custom p-4 mb-4 text-center border-lime">
        <p class="text-secondary small mb-1 text-uppercase" style="letter-spacing: 1px;">Total Net Worth / Aset</p>
        <h1 class="fw-bold text-lime display-6 mb-3">Rp{{ number_format($saldoAkhir, 0, ',', '.') }}</h1>

        <div class="row pt-3 border-top border-secondary border-opacity-25">
            <div class="col-6 border-end border-secondary border-opacity-25 text-start ps-3">
                <div class="text-secondary text-uppercase mb-1" style="font-size: 0.65rem;">Total Masuk</div>
                <div class="fw-bold text-white small">Rp{{ number_format($totalTabungan, 0, ',', '.') }}</div>
            </div>
            <div class="col-6 text-start ps-4">
                <div class="text-secondary text-uppercase mb-1" style="font-size: 0.65rem;">Total Keluar</div>
                <div class="fw-bold text-white small">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="card-custom p-3 mb-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="card-nested p-2.5 rounded-4 d-flex align-items-center justify-content-center text-lime" style="background-color: rgba(204, 255, 0, 0.1);">
                <i class="bi bi-hourglass-split fs-4"></i>
            </div>
            <div>
                <div class="text-secondary text-uppercase" style="font-size: 0.65rem;">Total Runway</div>
                <div class="fw-bold fs-5">{{ $totalRunway ?? 0.0 }} <span class="text-secondary fw-normal fs-6">Bulan</span></div>
            </div>
        </div>
        <span class="badge bg-secondary px-2.5 py-1.5 rounded-pill text-uppercase" style="font-size: 0.65rem;">Safe Mode</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6">
            <button class="btn card-custom w-100 p-3 text-start d-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#modalTransaksi">
                <div class="card-nested p-2 text-lime"><i class="bi bi-plus-circle-fill fs-5"></i></div>
                <div>
                    <div class="fw-bold text-white small">Catat Mutasi</div>
                    <small class="text-secondary" style="font-size: 0.7rem;">Tambah catatan baru</small>
                </div>
            </button>
        </div>
        <div class="col-6">
            <a href="{{ route('keuangan.arus-kas') }}" class="btn card-custom w-100 p-3 text-start d-flex align-items-center gap-3 text-decoration-none">
                <div class="card-nested p-2 text-secondary"><i class="bi bi-arrow-left-right fs-5"></i></div>
                <div>
                    <div class="fw-bold text-white small">Riwayat Kas</div>
                    <small class="text-secondary" style="font-size: 0.7rem;">Lihat semua mutasi</small>
                </div>
            </a>
        </div>
    </div>

    <div class="mb-2 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">Aktivitas Terbaru</h6>
        <a href="{{ route('keuangan.arus-kas') }}" class="text-lime text-decoration-none small" style="font-size: 0.8rem;">Lihat Semua</a>
    </div>

    <div class="d-flex flex-column gap-2 mb-4">
        @forelse($riwayatTabungan->take(2) as $tabung)
            <div class="card-custom p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-arrow-down-left-circle-fill text-lime fs-5"></i>
                    <div>
                        <div class="fw-bold text-white small">{{ $tabung->sumber }}</div>
                        <small class="text-secondary" style="font-size: 0.65rem;">{{ $tabung->tanggal }}</small>
                    </div>
                </div>
                <span class="fw-bold text-lime text-sm">+Rp{{ number_format($tabung->jumlah, 0, ',', '.') }}</span>
            </div>
        @empty
            <div class="text-center text-secondary small py-2 card-custom">Belum ada pemasukan terbaru</div>
        @endforelse

        @forelse($riwayatPengeluaran->take(2) as $keluar)
            <div class="card-custom p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-arrow-up-right-circle-fill text-danger-neon fs-5"></i>
                    <div>
                        <div class="fw-bold text-white small">{{ $keluar->keterangan }}</div>
                        <small class="text-secondary" style="font-size: 0.65rem;">{{ $keluar->tanggal }}</small>
                    </div>
                </div>
                <span class="fw-bold text-danger-neon text-sm">-Rp{{ number_format($keluar->jumlah, 0, ',', '.') }}</span>
            </div>
        @empty
            <div class="text-center text-secondary small py-2 card-custom">Belum ada pengeluaran terbaru</div>
        @endforelse
    </div>

    <div class="modal fade" id="modalTransaksi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom p-2 border-secondary border-opacity-50">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-white"><i class="bi bi-pencil-square text-lime me-2"></i>Catat Transaksi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills nav-justified mb-4 card-nested p-1" id="pills-tab" role="tablist" style="border-radius: 12px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active btn py-2 fw-bold text-sm" id="tab-tabungan" data-bs-toggle="pill" data-bs-target="#form-tabungan" type="button" role="tab" aria-controls="form-tabungan" aria-selected="true">Pemasukan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link btn py-2 fw-bold text-sm" id="tab-pengeluaran" data-bs-toggle="pill" data-bs-target="#form-pengeluaran" type="button" role="tab" aria-controls="form-pengeluaran" aria-selected="false">Pengeluaran</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="form-tabungan" role="tabpanel" aria-labelledby="tab-tabungan">
                            <form action="{{ route('tabungan.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Nominal Pemasukan (Rp)</label>
                                    <input type="number" name="jumlah" class="form-control form-control-custom" placeholder="Contoh: 50000" min="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Sumber Pemasukan</label>
                                    <input type="text" name="sumber" class="form-control form-control-custom" placeholder="Gaji Bulanan, Freelance, dll" required>
                                </div>

                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Keterangan Tambahan (Opsional)</label>
                                    <input type="text" name="keterangan" class="form-control form-control-custom" placeholder="Catatan tambahan...">
                                </div>

                                <div class="mb-4">
                                    <label class="small text-secondary mb-1">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <button type="submit" class="btn bg-lime w-100 py-2 rounded-3 fw-bold border-0">Simpan Pemasukan</button>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="form-pengeluaran" role="tabpanel" aria-labelledby="tab-pengeluaran">
                            <form action="{{ route('pengeluaran.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Nominal Pengeluaran (Rp)</label>
                                    <input type="number" name="jumlah" class="form-control form-control-custom" placeholder="Contoh: 15000" required>
                                </div>

                                <div class="mb-3">
                                    <label class="small text-secondary mb-1">Keterangan / Keperluan</label>
                                    <input type="text" name="keperluan" class="form-control form-control-custom" placeholder="Makan siang, bensin, token listrik" required>
                                </div>

                                <div class="mb-4">
                                    <label class="small text-secondary mb-1">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <button type="submit" class="btn bg-danger text-white w-100 py-2 rounded-3 fw-bold border-0">Simpan Pengeluaran</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    .border-lime { border: 1px solid #ccff00 !important; box-shadow: 0 0 15px rgba(204, 255, 0, 0.15); }
    .nav-pills .nav-link.active { background-color: #ccff00 !important; color: #000000 !important; }
    .nav-pills .nav-link { color: #ffffff; border-radius: 10px; }
    .form-control-custom { background-color: #1f2125 !important; border: 1px solid #2d3035 !important; color: #ffffff !important; border-radius: 12px; }
@endsection
