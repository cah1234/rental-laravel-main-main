<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $primaryKey = 'rekam_id'; // ← ini penting
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'kendaraan_id',
        'tanggal_servis',
        'keluhan',
        'status_servis',
    ];

    public function getRouteKeyName()
    {
        return 'rekam_id';
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'kendaraan_id');
    }
    public function teknisi()
{
    return $this->belongsTo(User::class, 'teknisi_id', 'user_id');
}
public function detailParts()
{
    return $this->hasMany(\App\Models\RekamDetailPart::class, 'rekam_id');
}

}
