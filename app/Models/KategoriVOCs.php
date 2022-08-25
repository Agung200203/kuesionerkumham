<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriVOCs extends Model
{
    use HasFactory;

    protected $table = 'kategori_vocs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namkat_vocs','status_kategori'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kuesioner(){
        return $this->hasMany(KuesionerVOCs::class,  'id_katvocs','id');
        // return $this->hasMany(ClassTujuan::class,  'atribut_tujuan','atribut_saya');
    }
}
