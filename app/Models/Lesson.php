<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ["course_id","title","lesson_detail"];

    public function course()
    {
        return $this->belongsTo(Course::class,"course_id","id");
    }

    public function bahanajar()
    {
        return $this->hasMany(BahanAjar::class,"lesson_id","id");
    }

    public function task()
    {
        return $this->hasMany(Task::class,"lesson_id","id");
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class,"lesson_id","id");
    }

}
