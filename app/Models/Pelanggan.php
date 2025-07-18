<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan'; // sesuai nama tabel di database
    protected $primaryKey = 'pelanggan_id'; // sesuai field PK
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_pelanggan',
        'no_telepon',
        'email',
        'alamat',
    ];
}
