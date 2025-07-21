<?php

namespace App\Http\Controllers;

use App\Models\SukuCadang;
use Illuminate\Http\Request;

class SukuCadangController extends Controller
{
    public function index()
    {
        $items = SukuCadang::paginate(10); 
        return view('pages.suku_cadang.index', compact('items'));
    }

    public function create()
    {
        return view('pages.suku_cadang.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'suku_cadang_id' => 'required|unique:suku_cadang,suku_cadang_id',
            'nama_barang' => 'required|string',
            'satuan' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        SukuCadang::create($validated);

        return redirect()->route('suku_cadang.index')->with('success', 'Data suku cadang berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sukuCadang = SukuCadang::where('suku_cadang_id', $id)->firstOrFail();
        return view('pages.suku_cadang.form', compact('sukuCadang'));
    }    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'suku_cadang_id' => 'required|unique:suku_cadang,suku_cadang_id,' . $id . ',suku_cadang_id',
            'nama_barang' => 'required|string',
            'satuan' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $sukuCadang = SukuCadang::findOrFail($id);
        $sukuCadang->update($validated);

        return redirect()->route('suku_cadang.index')->with('success', 'Data suku cadang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sukuCadang = SukuCadang::findOrFail($id);
        $sukuCadang->delete();

        return redirect()->route('suku_cadang.index')->with('success', 'Data suku cadang berhasil dihapus.');
    }

    public function pakaiSukuCadang(Request $request)
    {
        $request->validate([
            'suku_cadang_id' => 'required|exists:suku_cadang,suku_cadang_id',
            'jumlah_dipakai' => 'required|integer|min:1',
        ]);

        $sukuCadang = SukuCadang::findOrFail($request->suku_cadang_id);

        if ($sukuCadang->stok < $request->jumlah_dipakai) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok
        $sukuCadang->stok -= $request->jumlah_dipakai;
        $sukuCadang->save();

        // Simpan juga log atau relasi pemakaian jika perlu

        return redirect()->back()->with('success', 'Stok suku cadang berhasil dikurangi.');
    }

}
