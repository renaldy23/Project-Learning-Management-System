<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Lesson;
use Illuminate\Http\Request;;
use App\Models\Course;
use App\Models\Presence;
use App\Models\SiswaPresence;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $course = Lesson::with("course")
        //         ->join("courses","lessons.course_id","courses.id")
        //         ->join("course_class","courses.id","course_class.course_id")
        //         ->where("course_class.kelas_id",Auth::guard('student')->user()->kelas_id)
        //         ->orderBy("lessons.created_at","DESC")->take(5)->get();
        $course = Lesson::with("course")->orderBy("created_at","DESC")->take(5)->get();
        $presence = SiswaPresence::take(5)->orderBy("created_at","DESC")->get();

        return view("user.siswa.dashboard",[
            "course" => $course,
            "presences" => $presence
        ]);
    }

    public function index_guru()
    {
        $lesson = Lesson::with("course")
                ->join("courses","lessons.course_id","courses.id")
                ->where("courses.guru_id",Auth::guard('teacher')->user()->id)->get();
        return view("user.guru.dashboard",[
            "lesson" => $lesson
        ]);
    }
}
