<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePenilaian extends Model
{
    use HasFactory;

    protected $table = 'periode_penilaian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'bulan','tahun','periode','waktu_terbit','waktu_penutupan','status'
    ];

    // public function penilaianxxx(){}
}
