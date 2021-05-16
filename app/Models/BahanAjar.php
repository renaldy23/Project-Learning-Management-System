<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanAjar extends Model
{
    use HasFactory;
    protected $fillable = ["lesson_id","content"];
    protected $table = "bahan_ajar";

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,"lesson_id","id");
    }
}
