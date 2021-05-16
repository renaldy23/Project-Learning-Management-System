<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function store(Request $request,$id)
    {
        
        $task_id = $id;
        $user_id = Auth::guard('student')->user()->id;
        $name = "";
        if ($request->hasFile("file")) {
            $files = $request->file("file");
            $name = $files->getClientOriginalName();
            $files->move(public_path().'/submission_siswa',$name);
        }
        $submission = Submission::create([
            "task_id" => $task_id,
            "siswa_id" => $user_id,
            "online_text" => $request->text_online,
            "attach_files" => $name,
            "submitted_at" => date("Y-m-d H:i"),
            "status" => "Submitted"
        ]);

        return redirect()->back()->with("submission_store","Berhasil membuat submission baru!");
    }
}
