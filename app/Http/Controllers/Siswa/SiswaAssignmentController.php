<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAssignmentController extends Controller
{
    public function index()
    {
        $submission = Submission::with("task.lesson.course")->orderBy("submitted_at","DESC")
                    ->where("siswa_id",Auth::guard('student')->user()->id)->simplePaginate(5);
        return view("user.siswa.my_assignment",[
            "submission" => $submission
        ]);
    }
}
