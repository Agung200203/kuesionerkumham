<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianVOC extends Model
{
    use HasFactory;

    // 'id','kuesioner_id','id_master','jawaban','rating','nilaiTerbobot'

    protected $table = 'penilaianvocs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kuesioner_id','id_master','jawaban','rating','nilaiTerbobot'
    ];
    // protected $hidden = [];
    // protected $casts = [];
}
