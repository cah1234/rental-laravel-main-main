<?php

namespace App\Http\Controllers;

use App\Models\HasilPekerjaan;
use Illuminate\Http\Request;
use App\Models\Teknisi;
use App\Models\SukuCadang;


class HasilPekerjaanController extends Controller
{
    public function index()
    {
        $teknisis = HasilPekerjaan::with('sukuCadang')->latest()->get();
        return view('pages.hasil_kerja.index', compact('teknisis'));
    }

    public function create()
    {
        $order = Teknisi::latest()->first(); // atau sesuai logikamu
        $suku_cadang = SukuCadang::all();
        $items = SukuCadang::all(); // ambil semua data dari tabel suku_cadang
        return view('pages.hasil_kerja.index', compact('items'));

        return view('pages.hasil_kerja.hasil_kerja', compact('order', 'suku_cadang'));
        return view('pages.hasil_kerja.hasil_kerja');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:teknisis,id',
            'hasil_kerja' => 'required|string',
            'suku_cadang_id' => 'required|exists:suku_cadang,id',
            'jumlah' => 'required|integer|min:1',
            'saran' => 'nullable|string',
        ]);
    
        HasilPekerjaan::create([
            'order_id' => $request->order_id,
            'hasil_pekerjaan' => $request->hasil_kerja,
            'suku_cadang_id' => $request->suku_cadang_id,
            'jumlah_suku_cadang_diganti' => $request->jumlah,
            'saran' => $request->saran,
            'verifikasi' => 'belum_selesai', // default
        ]);
    
        return redirect()->route('hasil_kerja.index')->with('success', 'Hasil pekerjaan berhasil disimpan');
    }
    

    public function show($id)
    {
        $hasil = HasilPekerjaan::findOrFail($id);
        return view('pages.hasil_kerja.show', compact('hasil'));
    }

    public function edit($id)
    {
        $hasil = HasilPekerjaan::findOrFail($id);
        return view('pages.hasil_kerja.edit', compact('hasil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hasil_pekerjaan' => 'required',
            'suku_cadang_diganti' => 'required|string',
            'jumlah_suku_cadang_diganti' => 'required|integer|min:1',
            'saran' => 'nullable|string',
            'verifikasi' => 'required|in:selesai,belum_selesai',
        ]);

        $hasil = HasilPekerjaan::findOrFail($id);
        $hasil->update($request->all());

        return redirect()->route('hasil_kerja.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $hasil = HasilPekerjaan::findOrFail($id);
        $hasil->delete();

        return redirect()->route('hasil_kerja.index')->with('success', 'Data berhasil dihapus.');
    }

    public function form($id)
    {
        $teknisi = Teknisi::findOrFail($id); // ambil data dari teknisis
        $suku_cadang = SukuCadang::all(); // jika ada suku_cadang
    
        return view('pages.hasil_kerja.hasil_kerja', compact('Teknisi', 'SukuCadang'));
    }
    public function sukuCadang()
{
    return $this->belongsTo(SukuCadang::class, 'suku_cadang_id');
}

}