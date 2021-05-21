<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaGradesController extends Controller
{
    public function index()
    {
        $submission = Submission::with("task.lesson.course")
                    ->where("grade","!=",NULL)
                    ->where("siswa_id",Auth::guard('student')->user()->id)
                    ->get();
        $siswa_id = Auth::guard('student')->user()->id;
        $quiz = Quiz::with(["lesson.course","result" => function($q) use($siswa_id){
            $q->where('siswa_id',$siswa_id);
        },"siswa" => function($q) use($siswa_id){
            $q->where('siswa_id',$siswa_id);
        }])->orderBy("created_at","DESC")->simplePaginate(15);
        return view("user.siswa.grades",[
            "submission" => $submission,
            "quiz" => $quiz
        ]);
    }
}
