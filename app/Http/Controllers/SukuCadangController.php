<?php

namespace App\Http\Controllers;

use App\Models\SukuCadang;
use Illuminate\Http\Request;

class SukuCadangController extends Controller
{
    public function index()
    {
        $items = \App\Models\SukuCadang::all(); // HARUS dari model
        $items = \App\Models\SukuCadang::paginate(10); 
        return view('pages.suku_cadang.index', compact('items'));
        
    }

    public function create()
    {
        return view('pages.suku_cadang.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'suku_cadang_id' => 'required|unique:suku_cadangs,suku_cadang_id',
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
        $sukuCadang = SukuCadang::findOrFail($id);
        return view('pages.suku_cadang.form', compact('sukuCadang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'suku_cadang_id' => 'required|unique:suku_cadangs,suku_cadang_id,' . $id,
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
    public function getRouteKeyName()
{
    return 'id';
}

}

