<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;
    protected $fillable = ["quiz_id","siswa_id","point","correct_answer","max_points"];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class,"quiz_id","id");
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,"siswa_id","id");
    }
}
