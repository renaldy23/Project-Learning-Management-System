<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Kelas;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyClassController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with("siswa","course","jurusan")->where("walikelas_id",Auth::guard('teacher')->user()->id)->first();
        return view("user.guru.my_class",[
            "kelas" => $kelas
        ]);
    }

    public function task_detail($id)
    {
        $course = Course::findOrFail($id);
        $task = Lesson::with("task")->where("course_id",$id)->get();
        return view("user.guru.my_class.detail_task",[
            "course" => $course,
            "task" => $task
        ]);
    }
}
