<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Presence;
use App\Models\SiswaPresence;
use App\Models\Submission;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class SiswaCourseController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with("course")->where("id",Auth::guard('student')->user()->kelas_id)->first();
        return view("user.siswa.list_course",[
            "kelas" => $kelas
        ]);
    }

    public function detail($id)
    {
        $course = Course::with("lesson.task")->findOrFail($id);
        $course_id = $course->id;
        $presence = Presence::with(["siswapresence" => function($q) use($course_id){
            $q->where("siswa_id",Auth::guard('student')->user()->id);
        }])->where("course_id",$course_id)->get();
        return view("user.siswa.lesson.detail",[
            "course" => $course,
            "presence"=> $presence,
        ]);
    }

    public function lesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view("user.siswa.lesson.detail_lesson",[
            "lesson" => $lesson
        ]);
    }

    public function task_detail($id)
    {
        $task = Task::findOrFail($id);
        $submission = Submission::where("task_id",$task->id)
                    ->where("siswa_id",Auth::guard('student')->user()->id)
                    ->first();
        return view("user.siswa.lesson.task_detail",[
            "task" => $task,
            "submission" => $submission
        ]);
    }

    public function presence_attempt($id)
    {
        $presence = Presence::findOrFail($id);
        if (date("Y-m-d H:i")>date("Y-m-d H:i" , strtotime($presence->due_date))) {
            $status = "late";
        }
        else{
            $status = "done";
        }
        $user_id = Auth::guard('student')->user()->id;

        SiswaPresence::create([
            "siswa_id" => $user_id,
            "presence_id" => $presence->id,
            "status" => $status 
        ]);

        return redirect()->back()->with('presence_attempted',"Berhasil melakukan presensi!");
    }
}
