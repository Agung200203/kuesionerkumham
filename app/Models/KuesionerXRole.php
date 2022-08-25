<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerXRole extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_xrole';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_katxrole','namkuesxrole','bobot','kpd_role','status_kuesioner'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function kategori(){
        return $this->hasOne(KategoriXRole::class, 'id','id_katxrole' );
    }
}
