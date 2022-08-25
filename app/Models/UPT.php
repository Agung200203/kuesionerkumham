<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UPT extends Model
{
    use HasFactory;

    protected $table = 'upt';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode', 'nama', 'alamat', 'kapupt', 'email', 'no_telp', 'id_wil', 'status_upt'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_upt');
    }
    public function wilayah(){
        return $this->hasOne(Wilayah::class,'id', 'id_wil');
    }
}
