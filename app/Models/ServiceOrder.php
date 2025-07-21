<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'tanggal_servis',
        'keluhan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
    public function kendaraan()
{
    return $this->belongsTo(Kendaraan::class);
}


}

