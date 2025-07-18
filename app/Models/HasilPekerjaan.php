<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SukuCadang;

class HasilPekerjaan extends Model
{
    use HasFactory;

    // Pastikan sesuai dengan nama tabel di database
    protected $table = 'teknisis';

    // Isi kolom yang boleh di-mass-assign
    protected $fillable = [
        'order_id',
        'hasil_pekerjaan',
        'suku_cadang_id',
        'suku_cadang_diganti',
        'jumlah_suku_cadang_diganti',
        'saran',
        'verifikasi',
    ];
    
    public function sukuCadang()
{
    return $this->belongsTo(SukuCadang::class, 'suku_cadang_id');
}

}
