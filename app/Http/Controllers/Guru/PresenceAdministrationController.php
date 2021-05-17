<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\SiswaPresence;
use Illuminate\Http\Request;

class PresenceAdministrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "date" => "required",
            "time" => "required",
            "course_id" => "required"
        ]);
        $course_id = $request->course_id;
        $due_date = $request->date." ".$request->time.":00";
        $presence = Presence::create([
            "course_id" => $course_id,
            "title" => $request->title,
            "due_date" => $due_date
        ]);
        return redirect()->back()->with("presence_created","Berhasil membuat presensi baru!");
    }

    public function destroy($id)
    {
        $presence = Presence::findOrFail($id);
        $presence->delete();

        return redirect()->back()->with("presence_deleted","Berhasil menghapus presensi!");
    }

    public function detail($id)
    {
        $presence = Presence::with("siswapresence")->findOrFail($id);
        return view("user.guru.presence.detail",[
            "presence" => $presence
        ]);
    }
}
