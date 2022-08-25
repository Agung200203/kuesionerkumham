<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip', 
        'nama', 
        'tgl_lahir', 
        'tgl_masuk', 
        'pendidikan', 
        'gender', 
        'id_jabatan', 
        'id_upt', 
        'id_wilayah',
        'id_jab_upt',
        'id_atasan', 
        'no_telp', 
        'alamat', 
        'foto', 
        'status_pegawai'
    ];

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }
    public function wilayah()
    {
        return $this->hasOne(Wilayah::class, 'id', 'id_wilayah');
    }
    public function upt()
    {
        return $this->hasOne(UPT::class, 'id', 'id_upt');
    }
    public function jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'id_jabatan');
    }
    public function atasan()
    {
        return $this->hasOne(Pegawai::class,  'id', 'id_atasan');
    }
    // public function penilai(){
    //     return $this->hasMany(MasterPenilaianVOC::class,  'id','id_atasan' );
    // }
}
