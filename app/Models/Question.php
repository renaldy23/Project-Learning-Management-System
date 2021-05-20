<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        "quiz_id",
        "number",
        "question_title",
        "option_a",
        "option_b",
        "option_c",
        "option_d",
        "key",
        "nilai"];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class,"quiz_id","id");
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,"question_id","id");
    }
}
