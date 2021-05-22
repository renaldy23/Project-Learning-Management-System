<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $request->validate([
            "question" => "required",
            "option_a" => "required",
            "option_b" => "required",
            "option_c" => "required",
            "option_d" => "required",
            "nilai" => "required",
            "key" => "required"
        ]);
        
        $nilai = str_replace(",",".",$request->nilai);
        $valid_nilai = (double) $nilai;
        $quiz = Quiz::findOrFail($quiz_id);
        $number = $request->question_number;
        $key = strtoupper($request->key);
        Question::create([
            "quiz_id" => $quiz->id,
            "number" => $number,
            "question_title" => $request->question,
            "option_a" => $request->option_a,
            "option_b" => $request->option_b,
            "option_c" => $request->option_c,
            "option_d" => $request->option_d,
            "key" => $key,
            "nilai" => $valid_nilai
        ]);

        return redirect()->back()->with("question_create","Berhasil membuat pertanyaan baru!");
    }

    public function edit($id)
    {
        $quiz_id = request()->quiz_id;
        $question = Question::findOrFail($id);
        return view("user.guru.questions.edit",[
            "question" => $question,
            "quiz_id" => $quiz_id
        ]);
    }

    public function update($id , Request $request)
    {
        $quiz_id = $request->quiz_id;
        $request->validate([
            "question" => "required",
            "option_a" => "required",
            "option_b" => "required",
            "option_c" => "required",
            "option_d" => "required",
            "nilai" => "required",
            "key" => "required"
        ]);

        $nilai = str_replace(",",".",$request->nilai);
        $valid_nilai = (double) $nilai;
        $question = Question::findOrFail($id);
        $quiz = Quiz::findOrFail($quiz_id);
        $number = $request->question_number;
        $key = strtoupper($request->key);
        $question->update([
            "quiz_id" => $quiz->id,
            "number" => $number,
            "question_title" => $request->question,
            "option_a" => $request->option_a,
            "option_b" => $request->option_b,
            "option_c" => $request->option_c,
            "option_d" => $request->option_d,
            "key" => $key,
            "nilai" => $valid_nilai
        ]);

        return redirect()->route("detail.quiz",["id" => $quiz_id])->with('q_update',"Berhasil mengupdate pertanyaan");
    }

    public function destroy($id)
    {
        $course_id = request()->course_id;
        $quiz_id = request()->quiz_id;
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->to("guru/quiz/detail/$quiz_id?course_id=$course_id")->with("q_delete","Berhasil menghapus pertanyaan");
    }
}
