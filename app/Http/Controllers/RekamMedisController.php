<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    // Constructor dengan middleware auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan semua data
    public function index()
    {
        $items = RekamMedis::all();
        return view('pages.rekammedis.index', compact('items'));
    }

    // Menampilkan detail satu data
    public function show($id)
    {
        $item = RekamMedis::findOrFail($id);
        return view('pages.rekammedis.detail', compact('item'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'no_telpon' => 'required',
            'nomor_rangka' => 'required',
            'nomor_polisi' => 'required',
            'jenis_mobil' => 'required',
            'nama_customer' => 'required',
            'masalah_kerusakan' => 'required',
            'tanggal_kerusakan' => 'required|date',
            'dimana' => 'required'
        ]);

        RekamMedis::create($request->all());

        return redirect()->route('rekammedis.index')->with('success', 'Berhasil menambah data rekam medis.');
    }

    // Menghapus data
    public function destroy($id)
    {
        $item = RekamMedis::findOrFail($id);
        $item->delete();

        return redirect()->route('rekammedis.index')->with('success', 'Data rekam medis berhasil dihapus.');
    }
}
