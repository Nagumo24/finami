<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    // Tampilkan semua target impian
    public function index()
    {
        $goals = Goal::orderBy('created_at', 'desc')->get();
        return view('keuangan.goals', compact('goals'));
    }

    // Simpan target baru dari modal form
    public function store(Request $request)
    {
        $request->validate([
            'nama_target' => 'required|string|max:255',
            'nominal_target' => 'required|numeric|min:0',
            'nominal_terkumpul' => 'nullable|numeric|min:0',
            'tenggat_waktu' => 'nullable|date',
        ]);

        Goal::create([
            'nama_target' => $request->nama_target,
            'nominal_target' => $request->nominal_target,
            'nominal_terkumpul' => $request->nominal_terkumpul ?? 0,
            'tenggat_waktu' => $request->tenggat_waktu,
        ]);

        return redirect()->back()->with('success', 'Target impian baru berhasil ditambahkan!');
    }

        // Fungsi untuk menambah nominal uang yang terkumpul pada target
    public function tambahTabungan(Request $request, $id)
    {
        $request->validate([
            'jumlah_tabungan' => 'required|numeric|min:1',
        ]);

        $goal = Goal::findOrFail($id);

        // Tambahkan jumlah input baru ke total terkumpul saat ini
        $goal->nominal_terkumpul += $request->jumlah_tabungan;
        $goal->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan tabungan ke target!');
    }

    // Hapus target impian
    public function destroy($id)
    {
        $goal = Goal::findOrFail($id);
        $goal->delete();

        return redirect()->back()->with('success', 'Target berhasil dihapus.');
    }
}
