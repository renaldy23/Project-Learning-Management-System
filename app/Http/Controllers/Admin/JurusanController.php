<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::with("kelas.walikelas")->get();
        $kelas = Kelas::get();
        $guru = Guru::all();
        return view("admin.jurusan.list",[
            "title" => 'Daftar Kelas & Jurusan',
            "breadcumb_active" => "Jurusan",
            "jurusan" => $jurusan,
            "kelas" => $kelas,
            "guru" => $guru,
            "web_title" => "List Jurusan dan Kelas"
        ]);
    }

    public function walikelas(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "kelas" => "required"
        ]);

        $kelas_id = $request->kelas;
        $kelas = Kelas::find($kelas_id);
        $kelas->update([
            "walikelas_id" => $request->nama
        ]);

        return redirect()->back()->with("walikelas","Berhasil menambah wali kelas untuk ".$kelas->nama_kelas);
    }
}
