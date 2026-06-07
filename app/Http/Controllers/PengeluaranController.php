<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // Menyimpan data pengeluaran baru
    public function store(Request $request)
        {
            // 1. Validasi input wajib menggunakan 'keperluan'
            $request->validate([
                'tanggal' => 'required|date',
                'jumlah' => 'required|numeric|min:0',
                'keperluan' => 'required|string|max:255',
            ]);

            // 2. Simpan semua data ke database
            \App\Models\Pengeluaran::create($request->all());

            return redirect()->route('keuangan.index')->with('success', 'Data pengeluaran berhasil dipotong!');
        }

    // Menghapus data pengeluaran jika diperlukan
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('keuangan.index')->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
