<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $table = "siswa";
    protected $fillable = ["name","username","password","password_without_hash","nis","kelas_id","jurusan_id","status","last_online"];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,"jurusan_id","id");
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,"kelas_id","id");
    }

    public function siswapresence()
    {
        return $this->hasMany(SiswaPresence::class,"siswa_id","id");
    }

    public function submission()
    {
        return $this->hasMany(Submission::class,"siswa_id","id");
    }

    public function quiz()
    {
        return $this->belongsToMany(Quiz::class,"quiz_attempt")->withPivot("attempt_at");
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,"siswa_id","id");
    }

    public function result()
    {
        return $this->hasMany(QuizResult::class,"siswa_id","id");
    }
}
