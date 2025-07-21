<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Pelanggan;
use App\Models\Kendaraan;

use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    // Constructor dengan middleware auth
    public function __construct(){$this->middleware('auth');}

    // Menampilkan semua data
    public function index()
    {
        $items = RekamMedis::with('kendaraan.pelanggan')->get();
        $pelanggans = Pelanggan::pluck('nama_pelanggan', 'pelanggan_id');
        $kendaraans = Kendaraan::pluck('no_polisi', 'kendaraan_id');
    
        return view('pages.rekammedis.index', compact('items', 'pelanggans', 'kendaraans'));
    }
    
    public function getKendaraanByPelanggan($pelanggan_id)
{
    $kendaraan = Kendaraan::where('pelanggan_id', $pelanggan_id)->first();

    return response()->json([
        'kendaraan_id' => $kendaraan->kendaraan_id ?? '',
        'no_polisi' => $kendaraan->no_polisi ?? ''
      ]);
      
      
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
        $validated = $request->validate([
            'kendaraan_id' => 'required|numeric',
            'tanggal_servis' => 'required|date',
            'keluhan' => 'required|string',
            'status_servis' => 'nullable|string',
        ]);
    
        RekamMedis::create([
            'kendaraan_id' => (int) $validated['kendaraan_id'],
            'tanggal_servis' => $validated['tanggal_servis'],
            'keluhan' => $validated['keluhan'],
            'status_servis' => $validated['status_servis'] ?? null,
        ]);
    
        return redirect()->route('rekammedis.index')->with('success', 'Berhasil menambah data rekam medis.');
    }
    
    // Menghapus data
    public function destroy($id)
    {
        $item = RekamMedis::findOrFail($id);
        $item->delete();

        return redirect()->route('rekammedis.index')->with('success', 'Data rekam medis berhasil dihapus.');
    }

 public function update(Request $request, $id)
{
    $request->validate([
        'kendaraan_id'     => 'required|exists:kendaraan,kendaraan_id',
        'tanggal_servis'   => 'required|date',
        'keluhan'          => 'required|string',
        'tindakan_servis'  => 'nullable|string',
        'status_servis'    => 'nullable|string',
    ]);

    $item = RekamMedis::findOrFail($id);

    // Debug jika perlu:
    // dd($request->all());

    $item->update([
        'kendaraan_id'     => $request->kendaraan_id,
        'tanggal_servis'   => $request->tanggal_servis,
        'keluhan'          => $request->keluhan,
        'tindakan_servis'  => $request->tindakan_servis,
        'status_servis'    => $request->status_servis,
    ]);

    return redirect()->route('rekammedis.index')->with('success', 'Data berhasil diperbarui.');
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status_servis' => 'required|string',
    ]);

    $item = RekamMedis::findOrFail($id);
    $item->status_servis = $request->status_servis;
    $item->save();

    return redirect()->route('rekammedis.index')->with('success', 'Status servis diperbarui.');
}


 public function edit($id)
{
    $item = RekamMedis::findOrFail($id);

    // Ambil semua kendaraan untuk dropdown
    $kendaraans = Kendaraan::pluck('no_polisi', 'kendaraan_id');

    // Ambil daftar tanggal servis yang unik dari tabel rekam_medis
    $tanggalList = RekamMedis::pluck('tanggal_servis')->unique();

    return view('pages.rekammedis.edit', compact('item', 'kendaraans', 'tanggalList'));
}



}
