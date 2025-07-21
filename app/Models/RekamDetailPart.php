<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamDetailPart extends Model
{
    protected $table = 'rekam_detail_part'; // Nama tabel
    protected $fillable = [
        'rekam_id',
        'suku_cadang_id',
        'jumlah',
        'subtotal'
    ];
    
    public $timestamps = false;

    // Relasi ke suku cadang
    public function sukuCadang()
    {
        return $this->belongsTo(SukuCadang::class, 'suku_cadang_id');
    }

    // Relasi ke rekam medis
    public function rekam()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_id');
    }
}
