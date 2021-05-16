<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ["lesson_id","title","desc","due_date"];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,"lesson_id","id");
    }

    public function submission()
    {
        return $this->hasMany(Submission::class,"task_id","id");
    }
}
