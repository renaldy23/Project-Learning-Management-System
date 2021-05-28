<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AdministrationCourseController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $courses = Course::with("kelas")->get();
        return view("admin.course.list_course",[
            "title" => "Available Courses",
            "breadcumb_active" => "Course",
            "guru" => $guru,
            "kelas" => $kelas,
            "courses" => $courses,
            "web_title" => "LMS List Courses"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "guru" => "required"
        ]);

        $kelas_id = $request->kelas;
        $course = Course::create([
            "course_title" => $request->title,
            "guru_id" => $request->guru
        ]);
        $course->kelas()->attach($kelas_id);

        return redirect()->back()->with("courses_created","Berhasil menambah course ".$request->title);
    }

    public function edit($id)
    {
        $classes_id = [];
        $course = Course::findOrFail($id);
        foreach ($course->kelas as $kelas_id) {
            $classes_id[] = $kelas_id->id;
        }
        $kelas = Kelas::all();
        $guru = Guru::all();
        
        return view("admin.course.edit",[
            "title" => "Edit Course",
            "breadcumb_active" => "Edit Course",
            "course" => $course,
            "kelas" => $kelas,
            "guru" => $guru,
            "classes_id" => $classes_id,
            "web_title" => "Edit Course ".$course->course_title
        ]);
    }

    public function delete_class($id,$course_id)
    {
        $course = Course::findOrFail($course_id);
        
        $course->kelas()->detach($id);

        return redirect()->back()->with("class_deleted","Berhasil menghapus kelas dari course ".$course->course_title);
    }

    public function update($id,Request $request)
    {
        $available_class_id = [];
        $request->validate([
            "title" => "required",
            "guru" => "required"
        ]);

        $kelas_id = $request->kelas;
        $course = Course::findOrFail($id);
        $course->update([
            "course_title" => $request->title,
            "guru" => $request->guru
        ]);
        
        $deleted_id = [];
        foreach ($course->kelas as $val) {
            $available_class_id[] = $val->id;
            if (!in_array($val->id,$kelas_id)) {
                $deleted_id[] = $val->id;
            }
        }


        if ($course) {
            $new_kelas = [];
            $course->kelas()->detach($deleted_id);
            foreach($kelas_id as $value){
                if (!in_array($value,$available_class_id)) {
                    $new_kelas[] = $value;
                }

            }
            $course->kelas()->attach($new_kelas);

            return redirect()->route('admin.course')->with("updated","Berhasil mengupdate course ".$course->course_title);
        }
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with("deleted","Berhasil menghpaus course!");
    }
}
