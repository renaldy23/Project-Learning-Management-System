<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $fillable = ["course_id","title","due_date"];

    public function siswapresence()
    {
        return $this->hasMany(SiswaPresence::class,"presence_id","id");
    }

    public function course()
    {
        return $this->belongsTo(Course::class,"course_id","id");
    }
    
}
