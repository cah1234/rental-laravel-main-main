<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    use HasFactory;

    protected $table = 'suku_cadang'; // pastikan sesuai nama tabel
    protected $primaryKey = 'suku_cadang_id'; // ini yang penting!

    protected $fillable = [
        'suku_cadang_id',
        'nama_barang',
        'satuan',
        'harga',
        'stock',
    ];
}
