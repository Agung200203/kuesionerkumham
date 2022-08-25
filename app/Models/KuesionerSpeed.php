<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerSpeed extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_speedec';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_katspeed','namkuesspeed','bobot','kpd_role','status_kuesioner'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kategori(){
        return $this->hasOne(KategoriSpeed::class, 'id','id_katspeed');
    }
}
