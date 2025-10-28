<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim'];

    // membuat relasi ke wali
    public function wali()
    {
        // data mahassiswa bisa memiliki 1 data dari Wali
        // melalui fk id_mahasiswa
        return $this->hasOne(Wali::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function hobis()
    {
        return $this->belongsToMany(Hobi::class, 'mahasiswa_hobi', 'id_mahasiswa', 'id_hobi');
    }

}
