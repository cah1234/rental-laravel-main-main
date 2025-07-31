<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SukuCadang;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class KeluhanController extends Controller
{
    public function create()
    {
        $suku_cadangs = SukuCadang::all(); // Ambil semua komponen
        return view('pages.pelanggan.keluh', compact('suku_cadangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string',
            'suku_cadang_id' => 'nullable|array',
            'suku_cadang_id.*' => 'exists:suku_cadangs,id',
        ]);

        $user = Auth::user();

        if (!$user->pelanggan) {
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }

        $rekam = RekamMedis::create([
            'pelanggan_id' => $user->pelanggan->id,
            'keluhan' => $request->keluhan,
            'tanggal_servis' => now(),
        ]);

        if ($request->has('suku_cadang_id')) {
            foreach ($request->suku_cadang_id as $id) {
                $rekam->detailParts()->create([
                    'suku_cadang_id' => $id,
                    'jumlah' => 1,
                    'subtotal' => 0,
                ]);
            }
        }

        return redirect()->route('pelanggan.keluh')->with('success', 'Keluhan berhasil dikirim.');
    }
}
