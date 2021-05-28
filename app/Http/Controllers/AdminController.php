<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Lesson;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        $kelas = Kelas::all();
        $course = Course::all();
        $admin = Admin::all();
        $user = $siswa->count()+$guru->count();
        $online_siswa = Siswa::where("status","online")->get();
        $online_guru = Guru::where("status","online")->get();
        $lesson = Lesson::with("course")->orderBy("created_at","DESC")->get();

        return view("admin.dashboard",[
            "title" => "Dashboard",
            'breadcumb_active' => "Dashboard",
            "all_user" => $user,
            "all_kelas" => $kelas,
            "all_course" => $course,
            "all_admin" => $admin,
            "online_siswa" => $online_siswa,
            "online_guru" => $online_guru,
            "lesson" => $lesson,
            "web_title" => "Dashboard Admin"
        ]);
    }
}
