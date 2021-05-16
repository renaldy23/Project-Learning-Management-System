<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Submission;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskAdministrationController extends Controller
{
    public function create()
    {
        $lessons = Lesson::where("course_id",request()->course_id)->get();
        return view("user.guru.task.create",[
            "lessons" => $lessons
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:50",
            "lesson" => "required",
            "desc" => "required",
            "date" => "required",
            "time" => "required"
        ]);

        $date_time = $request->date." ".$request->time.":00";
        $task = Task::create([
            "lesson_id" => $request->lesson,
            "course_id" => $request->course_id,
            "title" => $request->title,
            "desc" => $request->desc,
            "due_date" => $date_time
        ]);

        return redirect()->route("my.course")->with("created_task","Berhasil membuat task baru!");
    }

    public function detail($id)
    {
        $task = Task::with("lesson.course")->findOrFail($id);
        return view("user.guru.task.detail",[
            "task" => $task
        ]);
    }

    public function edit($id)
    {
        $lessons = Lesson::all();
        $task = Task::findOrFail($id);

        return view("user.guru.task.edit",[
            "lessons" => $lessons,
            "task" => $task
        ]);
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            "title" => "required|max:50",
            "lesson" => "required",
            "desc" => "required",
            "date" => "required",
            "time" => "required"
        ]);
        $date_time = $request->date." ".$request->time.":00";
        $task = Task::findOrFail($id);
        $task->update([
            "lesson_id" => $request->lesson,
            "title" => $request->title,
            "desc" => $request->desc,
            "due_date" => $date_time
        ]);

        return redirect()->route("my.course")->with("updated_task","Berhasil mengupdate task ".$task->title);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route("my.course")->with("deleted_task","Berhasil menghapus task!");
    }
}
