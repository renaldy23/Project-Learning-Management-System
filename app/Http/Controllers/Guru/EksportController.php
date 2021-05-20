<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Eksport\EksportHandler;
use App\Models\Guru;
use App\Models\Siswa;
use PDF;

class EksportController extends Controller
{

    public function submission_eksport($id)
    {
        EksportHandler::eksport_submission($id);
    }

    public function siswa_eksport(Request $request)
    {
        $type = $request->type;
        $kelas_id = $request->kelas_id;
        if ($type=="excel") {
            EksportHandler::siswa_excel($kelas_id);
        }elseif($type=="pdf"){
            $siswa = Siswa::with("kelas","jurusan")->where("kelas_id",$kelas_id)->get();
            $pdf = PDF::loadView('admin.pdf.data_user', ["siswa" => $siswa]);
            return $pdf->download('Data User LMS '.date("Y-m-d").'.pdf');
        }else{

        }
    }

    public function guru_eksport(Request $request)
    {
        $type = $request->type;
        if ($type=="excel") {
            EksportHandler::guru_excel();
        } else {
            $guru = Guru::all();
            $pdf = PDF::loadView('admin.pdf.data_user_guru', ["guru" => $guru]);
            return $pdf->download('Data User LMS(GURU) '.date("Y-m-d").'.pdf');
        }
        
    }

    public function quiz_submitted($id)
    {
        EksportHandler::quiz_submitted($id);
    }

}
