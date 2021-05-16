<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = "jurusan";

    public function kelas()
    {
        return $this->hasMany(Kelas::class,"jurusan_id","id");
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class,"jurusan_id","id");
    }
}
