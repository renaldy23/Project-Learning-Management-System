<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ["course_title","guru_id"];

    public function guru()
    {
        return $this->belongsTo(Guru::class,"guru_id","id");
    }

    public function bahanajar()
    {
        return $this->hasMany(BahanAjar::class,"course_id","id");
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,"course_class");
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class,"course_id","id");
    }

    public function presence()
    {
        return $this->hasMany(Presence::class,"course_id","id");
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class,"course_id","id");
    }
}
