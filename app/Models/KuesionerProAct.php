<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerProAct extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_proact';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_katproacts','namkuesproacts','bobot','kpd_role','status_kuesioner'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kategori(){
        return $this->hasOne(KategoriProAct::class,'id', 'id_katproacts');
    }
}
