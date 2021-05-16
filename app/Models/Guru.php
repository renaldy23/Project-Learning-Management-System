<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory,Notifiable;
    protected $table="guru";
    protected $fillable = ["name","username","password","password_without_hash","nip","status","last_online"];


    public function kelas()
    {
        return $this->hasOne(Kelas::class,"walikelas_id","id");
    }

    public function course()
    {
        return $this->hasOne(Course::class,"guru_id","id");
    }

    public function submission()
    {
        return $this->hasMany(Submission::class,"guru_id","id");
    }
}
