<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = ["task_id","siswa_id","guru_id","submitted_at","online_text","attach_files","grade","graded_at","comment","status"];

    public function task()
    {
        return $this->belongsTo(Task::class,"task_id","id");
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,"siswa_id","id");
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class,"guru_id","id");
    }
}
