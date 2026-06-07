<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Tabungan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        // 1. Ambil data Minimal Pengeluaran secara dinamis dari database
        $pengaturan = DB::table('pengaturans')->first();
        // Jika di database belum ada datanya, gunakan nilai cadangan/default (misal 600.000)
        $minimalPengeluaran = 600000;

        // 2. Hitung Saldo & Aset
        $totalTabungan = Tabungan::sum('jumlah');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $saldoAkhir = $totalTabungan - $totalPengeluaran;

        // 3. Hitung Total Runway (Bulan Bertahan Hidup) secara dinamis
        $totalRunway = $minimalPengeluaran > 0 ? round($saldoAkhir / $minimalPengeluaran, 1) : 0;

        // Ambil riwayat untuk dashboard
        $riwayatTabungan = Tabungan::orderBy('tanggal', 'desc')->get();
        $riwayatPengeluaran = Pengeluaran::orderBy('tanggal', 'desc')->get();

        return view('keuangan.index', compact(
            'saldoAkhir',
            'totalTabungan',
            'totalPengeluaran',
            'totalRunway',
            'riwayatTabungan',
            'riwayatPengeluaran'));
    }

    public function goals()
    {
        // Mengambil data goals dengan pagination 3 item per halaman
        $goals = Goal::orderBy('target_tanggal', 'asc')->paginate(3);

        return view('keuangan.goals', compact('goals'));
    }

    public function profil()
    {
        $user = Auth::user();
        // Cek apakah ada data user di dalam session, jika tidak ada pakai data default
        $user = session('mock_user', (object) [
            'name' => 'Cyber Budggter',
            'email' => 'cyber.budgeter@domain.com',
            'pengeluaran_wajib' => 3000000,
            'level_finansial' => 'Bertahan'
        ]);

        return view('keuangan.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'pengeluaran_wajib' => 'required|numeric|min:0',
        ]);

        // Simpan perubahan ke dalam Session agar datanya persisten (tidak hilang saat di-refresh)
        $updatedUser = (object) [
            'name' => $request->nama,
            'email' => 'cyber.budgeter@domain.com',
            'pengeluaran_wajib' => $request->pengeluaran_wajib,
            'level_finansial' => 'Bertahan'
        ];

        session(['mock_user' => $updatedUser]);

        return redirect()->back()->with('success', 'Konfigurasi profil dan finansial berhasil diperbarui!');
    }

    public function arusKas()
    {
        // 1. Ambil riwayat tabungan dan tandai sebagai tipe 'pemasukan'
        $tabungan = \App\Models\Tabungan::select('id', 'jumlah', 'keterangan', 'tanggal')
            ->get()
            ->map(function ($item) {
                $item->tipe = 'pemasukan';
                return $item;
            });

        // 2. Ambil riwayat pengeluaran dan tandai sebagai tipe 'pengeluaran'
        $pengeluaran = \App\Models\Pengeluaran::select('id', 'jumlah', 'keterangan', 'tanggal')
            ->get()
            ->map(function ($item) {
                $item->tipe = 'pengeluaran';
                return $item;
            });

        // 3. Gabungkan kedua data dan urutkan berdasarkan tanggal terbaru (descending)
        $semuaTransaksi = $tabungan->concat($pengeluaran)->sortByDesc('tanggal');

        return view('keuangan.arus_kas', compact('semuaTransaksi'));
    }

    public function pengaturan()
    {
        // Mengambil data session user yang sama agar sinkron
        $user = session('mock_user', (object) [
            'name' => 'Cyber Budggter',
            'email' => 'cyber.budgeter@domain.com',
            'pengeluaran_wajib' => 3000000,
            'level_finansial' => 'Bertahan'
        ]);

        return view('keuangan.pengaturan', compact('user'));
    }
    public function notifikasi()
        {
            // 1. Ambil data Pengaturan Finansial untuk cek Runway kritis
            $pengaturan = DB::table('pengaturans')->first();
            $minimalPengeluaran = 600000;

            $totalTabungan = Tabungan::sum('jumlah');
            $totalPengeluaran = Pengeluaran::sum('jumlah');
            $saldoAkhir = $totalTabungan - $totalPengeluaran;

            $totalRunway = $minimalPengeluaran > 0 ? round($saldoAkhir / $minimalPengeluaran, 1) : 0;

            // 2. Log Notifikasi Transaksi Masuk & Keluar
            $pemasukanTerbaru = Tabungan::orderBy('created_at', 'desc')->take(5)->get()->map(function ($item) {
                return [
                    'tipe' => 'pemasukan',
                    'judul' => 'Pemasukan Berhasil Dicatat!',
                    'pesan' => "Dana sebesar Rp " . number_format($item->jumlah, 0, ',', '.') . " dari '{$item->sumber}' telah ditambahkan ke aset.",
                    'waktu' => $item->created_at,
                ];
            });

            $pengeluaranTerbaru = Pengeluaran::orderBy('created_at', 'desc')->take(5)->get()->map(function ($item) {
                return [
                    'tipe' => 'pengeluaran',
                    'judul' => 'Pengeluaran Berhasil Dipotong!',
                    'pesan' => "Aset kamu berkurang Rp " . number_format($item->jumlah, 0, ',', '.') . " untuk keperluan '{$item->keperluan}'.",
                    'waktu' => $item->created_at,
                ];
            });

            $notifikasiTransaksi = collect($pemasukanTerbaru)->merge($pengeluaranTerbaru)->sortByDesc('waktu');

            return view('keuangan.notifikasi', compact('totalRunway', 'notifikasiTransaksi'));
        }
    }
