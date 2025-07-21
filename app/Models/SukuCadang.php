<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    protected $table = 'suku_cadang'; // <-- INI PENTING
    protected $primaryKey = 'suku_cadang_id';

    protected $fillable = [
        'nama_barang', 'satuan', 'harga', 'stok',  ];

    public $timestamps = false;

  
}
