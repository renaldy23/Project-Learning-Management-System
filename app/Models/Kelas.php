<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ["nama_kelas","walikelas_id"];
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function walikelas()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class,"kelas_id","id");
    }

    public function course()
    {
        return $this->belongsToMany(Course::class,"course_class");
    }
}
