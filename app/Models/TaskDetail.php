<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    use HasFactory;

    protected $fillable = ["task_id","attach_files"];

    public function task()
    {
        return $this->belongsTo(Task::class,"task_id","id");
    }
}
