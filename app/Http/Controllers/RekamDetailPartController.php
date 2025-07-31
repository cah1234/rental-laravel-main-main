<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamDetailPart;
use App\Models\RekamMedis;
use App\Models\SukuCadang;
use Illuminate\Support\Str;

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
        $rekams = RekamMedis::with('kendaraan')->orderBy('rekam_id', 'desc')->get();
        $suku_cadang = SukuCadang::all();

        return view('pages.rekam_detail_part.create', compact('rekams', 'suku_cadang'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'suku_cadang_id' => 'required|exists:suku_cadang,suku_cadang_id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $rekamId = $request->input('rekam_id');

    if (empty($rekamId)) {
        do {
            $rekamId = mt_rand(100000, 999999);
        } while (RekamDetailPart::where('rekam_id', $rekamId)->exists());
    }

    $sukuCadang = SukuCadang::where('suku_cadang_id', $validated['suku_cadang_id'])->first();

    if (!$sukuCadang) {
        return back()->with('error', 'Suku cadang tidak ditemukan.');
    }

    // 🔽 CEK apakah stok mencukupi
    if ($sukuCadang->stok < $validated['jumlah']) {
        return back()->with('error', 'Stok tidak mencukupi untuk suku cadang yang dipilih.');
    }

    $harga = $sukuCadang->harga;
    $subtotal = $harga * $validated['jumlah'];

    // 🔽 KURANGI STOK suku cadang
    $sukuCadang->stok -= $validated['jumlah'];
    $sukuCadang->save();

    // 🔽 SIMPAN rekam detail part
    RekamDetailPart::create([
        'rekam_id' => $rekamId,
        'suku_cadang_id' => $validated['suku_cadang_id'],
        'jumlah' => $validated['jumlah'],
        'subtotal' => $subtotal,
    ]);

    return redirect()->route('rekam_detail_part.index')->with('success', 'Data berhasil ditambahkan.');
}


    public function show($id)
    {
        $hasil = RekamDetailPart::with('sukuCadang', 'rekam.kendaraan')->findOrFail($id);
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
            'jumlah' => 'required|integer|min:1',
        ]);

        $item = RekamDetailPart::findOrFail($id);
        $sukuCadang = SukuCadang::where('suku_cadang_id', $item->suku_cadang_id)->first();

        $subtotal = $sukuCadang->harga * $request->jumlah;

        $item->update([
            'jumlah' => $request->jumlah,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('rekam_detail_part.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RekamDetailPart::findOrFail($id)->delete();
        return redirect()->route('rekam_detail_part.index')->with('success', 'Data berhasil dihapus.');
    }
}
