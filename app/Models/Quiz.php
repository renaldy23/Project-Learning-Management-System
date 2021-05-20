<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ["course_id","lesson_id","title","instructions","number_of_question","access_type","due_date","allowed_attempt"];

    public function course()
    {
        return $this->belongsTo(Course::class,"course_id","id");
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,"lesson_id","id");
    }

    public function question()
    {
        return $this->hasMany(Question::class,"quiz_id","id");
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class,"quiz_attempt")->withPivot("attempt_at");
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,"quiz_id","id");
    }

    public function result()
    {
        return $this->hasMany(QuizResult::class,"quiz_id","id");
    }
}
