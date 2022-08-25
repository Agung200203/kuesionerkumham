<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPenilaianVOC extends Model
{
    // 'id','id_user_penilai','id_user_pegawai','id_periode','status','total','sub1','sub2','sub3','sub4','sub5','sub6','sub7','sub8','sub9','sub10','created_at','updated_at'
    use HasFactory;

    protected $table = 'master_penilaianvocs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user_penilai', // penilai (pegawai)
        'id_user_pegawai', // dinilai (pegawai)
        'id_periode', // periode penilaian yang saat itu aktif
        'status', // status master penilaian aktif ditujukan kepada apa? 1=atas,2=sejawat,3=bawahan,4=dirinya, 0=off & hidden
        'total',
        'sub1',
        'sub2',
        'sub3',
        'sub4',
        'sub5',
        'sub6',
        'sub7',
        'sub8',
        'sub9',
        'sub10'
    ];
    // protected $hidden = [];
    // protected $casts = [];

    public function penilai()
    {
        return $this->hasMany(Pegawai::class,  'id', 'id_user_penilai');
    }

    public function dinilai()
    {
        return $this->hasMany(Pegawai::class,  'id', 'id_user_pegawai');
    }

    public function periode()
    {
        return $this->hasMany(PeriodePenilaian::class,  'id', 'id_periode');
    }
}
