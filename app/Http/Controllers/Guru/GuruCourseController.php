<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\SiswaPresence;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruCourseController extends Controller
{
    public function index()
    {
        $my_course = Course::with("kelas","lesson.task","presence_detail")->where("guru_id",Auth::guard('teacher')->user()->id)->first();
        $count = SiswaPresence::where("course_id",$my_course->id)->count();
        $tasks = Task::with("lesson")->where("course_id",$my_course->id)->get();
        return view("user.guru.my_course",[
            "my_course" => $my_course,
            "tasks" => $tasks,
            "count" => $count
        ]);
    }

   
}
