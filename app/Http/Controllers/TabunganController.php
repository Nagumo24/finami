<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    // Menyimpan data tabungan baru
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'sumber' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // 2. Simpan semua data langsung ke database (termasuk 'sumber')
        Tabungan::create($request->all());

        // 3. Kembalikan ke halaman utama keuangan
        return redirect()->route('keuangan.index')->with('success', 'Data tabungan berhasil ditambahkan!');
    }

    // Menghapus data tabungan
    public function destroy($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        $tabungan->delete();

        return redirect()->route('keuangan.index')->with('success', 'Data tabungan berhasil dihapus!');
    }
}
