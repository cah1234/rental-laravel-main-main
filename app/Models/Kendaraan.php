<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan'; // atau 'kendaraans' jika default Laravel

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'kendaraan_id');
    }
}
