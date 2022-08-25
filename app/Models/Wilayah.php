<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'alamat', 'kakanwil', 'email', 'no_telp', 'status_wilayah'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function pegawai(){
        return $this->belongsTo(pegawai::class, 'id_wilayah','id');
    }
    public function upt(){
        return $this->hasMany(upt::class, 'id_wil', 'id');
    }
}
