<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaGradesController extends Controller
{
    public function index()
    {
        $course = Kelas::with("course")->where("id",Auth::guard('student')->user()->kelas_id)->first();
        $submission = Submission::with("task.lesson.course")
                    ->where("grade","!=",NULL)
                    ->where("siswa_id",Auth::guard('student')->user()->id)
                    ->get();
        return view("user.siswa.grades",[
            "submission" => $submission,
            "kelas" => $course
        ]);
    }
}
