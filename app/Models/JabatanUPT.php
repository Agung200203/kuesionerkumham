<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanUPT extends Model
{
    use HasFactory;

    protected $table = 'jab_upt';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jab_id',
        'upt_id',
        'wil_id',
        'jab_atas_id',
        'upt_atas_id',
        'wil_atas_id',
        'hub_sejawat',
        'jab_puk',
        'upt_puk',
        'wil_puk'
    ];
}
