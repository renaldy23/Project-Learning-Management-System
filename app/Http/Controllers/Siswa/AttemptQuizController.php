<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttemptQuizController extends Controller
{
    public function index($id)
    {
        $user_id = Auth::guard('student')->user()->id;
        $quiz = Quiz::with(["siswa" => function($q) use($user_id){
            $q->where("siswa_id",$user_id);
        }, "answer" => function($q) use($user_id){
            $q->where('siswa_id',$user_id);
        },"result" => function($q) use($user_id){
            $q->where("siswa_id",$user_id);
        }])->findOrFail($id);
        return view("user.siswa.quizzes.detail",[
            "quiz" => $quiz
        ]);
    }

    public function attempt($id)
    {
        $siswa_id = Auth::guard('student')->user()->id;
        $quiz = Quiz::with(["question","siswa" => function($q) use($siswa_id){
            $q->where("siswa_id",$siswa_id);
        }])->findOrFail($id);
        if ($quiz->siswa->count()!=$quiz->allowed_attempt) {
            $quiz->siswa()->attach($siswa_id,[
                "attempt_at" => date("Y-m-d H:i:s")
            ]);
            return view("user.siswa.quizzes.take",[
                "quiz" => $quiz ,
                "attempt" => true
            ]);
        }

    }
    public function result($id , Request $request)
    {
        $quiz = Quiz::findOrFail($id);
        $nilai = 0;
        $correct = 0;
        $max_point = 0;
        $siswa_id = Auth::guard('student')->user()->id;
        foreach ($quiz->question as $val) {
            if ($request->input("options".$val->id) == $val->key) {
                $nilai += $val->nilai;
                $correct++;
            }
            $max_point += $val->nilai;
            Answer::create([
                "quiz_id" => $quiz->id,
                "question_id" => $val->id,
                "siswa_id" => $siswa_id,
                "option" => $request->input("options".$val->id)
            ]);
        }

        QuizResult::create([
            "quiz_id" => $quiz->id,
            "siswa_id" => $siswa_id,
            "point" => $nilai,
            "correct_answer" => $correct,
            "max_points" => $max_point
        ]);

        return redirect()->route("lesson.quiz.detail",["id" => $quiz->id]);
    }
}
