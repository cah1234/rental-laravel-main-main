<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamDetailPart;
use App\Models\RekamMedis;
use App\Models\SukuCadang;
use Illuminate\Support\Facades\Log;

class RekamDetailPartController extends Controller
{
    public function index()
    {
        $rekamDetails = RekamDetailPart::with('sukuCadang', 'rekam.kendaraan')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.rekam_detail_part.index', compact('rekamDetails'));
    }

    public function create()
    {
        $harga = 10000; // atau ambil dari suku cadang
  
        $rekams = RekamMedis::with('kendaraan')
            ->orderBy('rekam_id', 'desc')
            ->get();

        $suku_cadangs = SukuCadang::all();

        return view('pages.rekam_detail_part.create', compact('harga','rekams', 'suku_cadangs'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'rekam_id' => 'required|exists:rekam_medis,rekam_id',
        'suku_cadang_id' => 'required|exists:suku_cadangs,id',
        'jumlah' => 'required|integer|min:1',
        'subtotal' => 'required|numeric',
    ]);

    try {
        RekamDetailPart::create([
            'rekam_id' => $validated['rekam_id'],
            'suku_cadang_id' => $validated['suku_cadang_id'],
            'jumlah' => $validated['jumlah'],
            'subtotal' => $validated['subtotal'],
        ]);

        return redirect()->route('rekam_detail_part.index')->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan Rekam Detail Part: '.$e->getMessage());
        return back()->withInput()->withErrors(['msg' => 'Terjadi kesalahan saat menyimpan data.']);
    }
}

    
    

    public function show($id)
    {
        $hasil = RekamDetailPart::with('sukuCadang', 'rekam.kendaraan')
            ->findOrFail($id);

        return view('pages.rekam_detail_part.show', compact('hasil'));
    }

    public function edit($id)
    {
        $hasil = RekamDetailPart::findOrFail($id);
        $suku_cadang = SukuCadang::all();

        return view('pages.rekam_detail_part.edit', compact('hasil', 'suku_cadang'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'hasil_pekerjaan' => 'required|string',
        'suku_cadang_diganti' => 'required|string',
        'jumlah_suku_cadang_diganti' => 'required|integer',
        'saran' => 'nullable|string',
        'verifikasi' => 'required|in:belum_selesai,selesai',
    ]);

    $item = RekamDetailPart::findOrFail($id);

    $item->update([
        'hasil_pekerjaan' => $request->hasil_pekerjaan,
        'suku_cadang_diganti' => $request->suku_cadang_diganti,
        'jumlah_suku_cadang_diganti' => $request->jumlah_suku_cadang_diganti,
        'saran' => $request->saran,
        'verifikasi' => $request->verifikasi,
    ]);

    return redirect()->route('hasil_kerja.index')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
    {
        RekamDetailPart::findOrFail($id)->delete();

        return redirect()
            ->route('rekam_detail_part.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
