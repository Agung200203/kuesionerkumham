<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerVOCs extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_vocs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_katvocs','namkuesvocs','bobot','kpd_role','status_kuesioner'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kategori(){
        return $this->hasOne(KategoriVOCs::class, 'id','id_katvocs');
    }
}
