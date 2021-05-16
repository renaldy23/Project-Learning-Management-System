<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaPresence extends Model
{
    use HasFactory;
    protected $table = "presence_detail";
    protected $fillable = ["siswa_id","presence_id","status","course_id"];

    public function presence()
    {
        return $this->belongsTo(Presence::class,"presence_id","id");
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,"siswa_id","id");
    }

    public function course()
    {
        return $this->belongsTo(Course::class,"course_id","id");
    }
}
