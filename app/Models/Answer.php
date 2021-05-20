<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ["quiz_id","question_id","siswa_id","option"];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class,"quiz_id","id");
    }

    public function question()
    {
        return $this->belongsTo(Question::class,"question_id","id");
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,"siswa_id","id");
    }
}
