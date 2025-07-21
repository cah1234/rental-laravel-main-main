<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'kendaraan_id'; // ✅ tambahkan ini
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['jenis_kendaraan', 'merk', 'nomor_polisi'];

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'kendaraan_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'kendaraan_id');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }
    
}
