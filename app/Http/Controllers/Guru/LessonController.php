<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\BahanAjar;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create()
    {
        return view("user.guru.lesson.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:100",
            "lesson_detail" => "required"
        ]);
        
        $course = Course::findOrFail($request->course_id);
        $lesson = Lesson::create([
            "course_id" => $course->id,
            "title" => $request->title,
            "lesson_detail" => $request->lesson_detail
        ]);
        $last_id = $lesson->id;
        if ($request->hasFile("file")) {
            foreach ($request->file("file") as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/bahanajar',$name);
                BahanAjar::create([
                    "lesson_id" => $last_id,
                    "content" => $name
                ]);
            }
        }

        return redirect()->route("my.course")->with("success_create_lesson","Berhasil membuat lesson baru untuk course ".$course->course_title);
    }

    public function detail($id)
    {
        $lesson = Lesson::with("bahanajar")->findOrFail($id);
        return view("user.guru.lesson.detail",[
            "lesson" => $lesson
        ]);
    }

    public function edit($id)
    {
        $lesson = Lesson::with('bahanajar')->findOrFail($id);
        return view("user.guru.lesson.edit",[
            "lesson" => $lesson
        ]);
    }

    public function bahanajar_delete($id)
    {
        $bahanajar = BahanAjar::findOrFail($id);
        $path = public_path()."/bahanajar/".$bahanajar->content;
        unlink($path);
        $bahanajar->delete();
        return redirect()->back()->with("success_deleted","Berhasil menghapus bahan ajar!");
    }

    public function update($id , Request $request)
    {
        $request->validate([
            "title" => "required|max:100",
            "lesson_detail" => "required"
        ]);
        $course = Course::findOrFail($request->course_id);
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            "course_id" => $course->id,
            "title" => $request->title,
            "lesson_detail" => $request->lesson_detail
        ]);

        $last_id = $lesson->id;
        if ($request->hasFile("file")) {
            foreach ($request->file("file") as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/bahanajar',$name);
                BahanAjar::create([
                    "lesson_id" => $last_id,
                    "content" => $name
                ]);
            }
        }

        return redirect()->route("my.course")->with("success_update_lesson","Berhasil mengupdate lesson ". $lesson->title ." untuk course ".$course->course_title);
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        foreach ($lesson->bahanajar as $item) {
            $path = public_path()."/bahanajar/".$item->content;
            unlink($path);
        }
        $lesson->delete();

        return redirect()->route("my.course")->with("success_delete_lesson","Berhasil menghapus lesson");
    }

    public function duplicate($id)
    {
        $lesson = Lesson::with("bahanajar")->findOrFail($id);
        $new_lesson = $lesson->replicate();
        $new_lesson->save();

        $relations = $lesson->getRelation("bahanajar");
        foreach ($relations as $relation) {
            $new_relation = $relation->replicate();
            $new_relation->lesson_id = $new_lesson->id;
            $new_relation->push();
        }


        return redirect()->back();
    }
}
