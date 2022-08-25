<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProAct extends Model
{
    use HasFactory;

    protected $table = 'kategori_proact';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namkat_proact','status_kategori'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kuesioner(){
        return $this->hasMany(KuesionerProAct::class,'id_katproacts', 'id');
    }
}
