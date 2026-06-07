<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Tabungan;
use App\Models\Pengeluaran;

class ProfilController extends Controller
{
    public function index()
    {
        return view('keuangan.profil');
    }

    public function resetData()
    {
        // Menghapus seluruh record data tanpa menghapus tabelnya
        Tabungan::truncate();
        Pengeluaran::truncate();

        return redirect()->route('keuangan.index')->with('success', 'Sistem berhasil diformat! Semua catatan kembali ke nol.');
    }

    public function keamanan()
    {
        return view('keuangan.keamanan');
    }

    // Memproses pembaruan kata sandi
    // --- 1. FUNGSI BARU: UPDATE NAMA & EMAIL ---
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update data ke database
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('keuangan.index')->with('success', 'Identitas ID sistem berhasil diperbarui!');
    }

    // --- 2. FUNGSI UPDATE PASSWORD (YANG SUDAH ADA) ---
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok dengan catatan kami.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('keuangan.index')->with('success', 'Dekripsi kunci keamanan berhasil diperbarui!');
    }

    public function logSistem()
    {
        // Mengambil 5 pengeluaran terbaru untuk dijadikan log mutasi data
        $logsKeluaran = Pengeluaran::latest()->take(5)->get();

        return view('keuangan.log_sistem', compact('logsKeluaran'));
    }
}
