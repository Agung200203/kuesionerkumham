<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSpeed extends Model
{
    use HasFactory;

    protected $table = 'kategori_speedec';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namkat_speed','status_kategori'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kuesioner(){
        return $this->hasMany(KuesionerSpeed::class,'id_katspeed', 'id');
    }
}
