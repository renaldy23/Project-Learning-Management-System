<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Presence;
use App\Models\SiswaPresence;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruCourseController extends Controller
{
    public function index()
    {
        $my_course = Course::with("kelas","lesson.task","presence","quiz")->where("guru_id",Auth::guard('teacher')->user()->id)->first();
        if ($my_course==null) {
            return redirect()->route("dashboard.guru");
        }
        $presence = Presence::where("course_id",$my_course->id)->get();
        $tasks = Task::with("lesson")->where("course_id",$my_course->id)->get();
        return view("user.guru.my_course",[
            "my_course" => $my_course,
            "tasks" => $tasks,
            "presence" => $presence
        ]);
    }

   
}
