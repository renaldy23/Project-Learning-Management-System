<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function update($id, Request $request)
    {
        $request->validate([
            "grade" => "required|integer"
        ]);
        $submission = Submission::findOrFail($id);
        $guru_id = Auth::guard('teacher')->user()->id;
        $date = date("Y-m-d H:i");
        $graded = $date.":00";
        $comment = $request->comment;
        $submission->update([
            "guru_id" => $guru_id,
            "grade" => $request->grade,
            "graded_at" => $graded,
            "status" => "Graded",
            "comment" => $comment
        ]);

        return redirect()->back();
    }
}
