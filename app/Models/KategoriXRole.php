<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriXRole extends Model
{
    use HasFactory;

    protected $table = 'kategori_xrole';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namkat_xrole','status_kategori'
    ];

    public function kuesioner(){
        return  $this->hasMany(KuesionerXRole::class, 'id_katxrole', 'id' );
    }
}
