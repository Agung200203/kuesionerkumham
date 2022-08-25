<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_jabatan', 'nama', 'status_jabatan'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function jabatan(){
        return $this->belongsTo(pegawai::class, 'id_jabatan');
    }
}
