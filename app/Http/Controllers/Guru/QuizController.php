<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function create()
    {
        $course_id = request()->course_id;
        $lesson = Lesson::where("course_id",$course_id)->get();
        return view("user.guru.quiz.create",[
            "lesson" => $lesson
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:50",
            "lesson_id" => "required",
            "amount_of_question" => "required|numeric",
            "date" => "required",
            "time" => "required"
        ]);
        $attempt = "1";

        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        $due_date = $request->date." ".$request->time.":00";
        Quiz::create([
            "course_id" => $course_id,
            "lesson_id" => $request->lesson_id,
            "title" => $request->title,
            "instructions" => $request->instructions,
            "number_of_question" => $request->amount_of_question,
            "access_type" => "Closed",
            "due_date" => $due_date,
            "allowed_attempt" => $attempt
        ]);

        return redirect()->route("my.course")->with("quiz_create","Berhasil membuat quiz baru untuk course ".$course->course_title);
    }

    public function detail($id)
    {
        $quiz = Quiz::with("siswa")->findOrFail($id);
        return view("user.guru.quiz.detail",[
            "quiz" => $quiz,
        ]);
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $course_id = request()->course_id;
        $lesson = Lesson::where("course_id",$course_id)->get();
        return view("user.guru.quiz.edit",[
            "lesson" => $lesson,
            "quiz" => $quiz
        ]);
    }

    public function update(Request $request,$id)
    {
        $quiz = Quiz::findOrFail($id);
        $request->validate([
            "title" => "required|max:50",
            "lesson_id" => "required",
            "amount_of_question" => "required|numeric",
            "date" => "required",
            "time" => "required"
        ]);

        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        $due_date = $request->date." ".$request->time.":00";
        $attempt = "1";

        if ($quiz->question->count()!=0) {
            if ($request->amount_of_question<$quiz->question->count()) {
                $less = $quiz->question->count()-$request->amount_of_question;
                for ($i=1; $i <= $less ; $i++) { 
                    Question::orderBy("id","desc")->limit(1)->delete();
                }
            }    
        }
        $quiz->update([
            "course_id" => $course_id,
            "lesson_id" => $request->lesson_id,
            "title" => $request->title,
            "instructions" => $request->instructions,
            "number_of_question" => $request->amount_of_question,
            "access_type" => "Closed",
            "due_date" => $due_date,
            "allowed_attempt" => $attempt
        ]);

        return redirect()->route("my.course")->with("quiz_update","Berhasil membuat quiz baru untuk course ".$course->course_title);
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route("my.course")->with("quiz_deleted","Berhasil menghapus quiz!");
    }

    public function access_open($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            "access_type" => "Opened"
        ]);

        return redirect()->back()->with("openen_access","Berhasil membuka akses quiz ini!");
    }

    public function submitted($id)
    {
        $quiz = Quiz::with("siswa","result")->findOrFail($id);
        return view("user.guru.quiz.submitted",[
            "quiz" => $quiz,
        ]);
    }
}
