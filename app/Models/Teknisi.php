<?php

// app/Models/Teknisi.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;

    protected $table = 'teknisis'; // sesuaikan dengan nama tabel

    protected $fillable = [
        'hasil_pekerjaan',
        'suku_cadang_diganti',
        'jumlah_suku_cadang_diganti',
        'saran',
        'verifikasi',
        // tambah jika ada kolom lain
    ];
}
