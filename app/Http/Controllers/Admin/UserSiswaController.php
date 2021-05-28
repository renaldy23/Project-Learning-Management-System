<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with("jurusan","kelas")->get();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view("admin.siswa.list_siswa",[
            "title" => "Data User Siswa",
            "breadcumb_active" => 'Data User Siswa',
            "siswa" => $siswa,
            "kelas" => $kelas,
            "jurusan" => $jurusan,
            "web_title" => "List Siswa"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_depan" => "required",
            "nama_belakang" => "required",
            "nis" => "required",
            "jurusan" => 'required',
            "kelas" => "required",
            "password" => "required"
        ]);

        $lower = strtolower($request->nama_depan);
        $username = $lower."".rand(10000,20000);
        $username_no_space = str_replace(" ","",$username);
        $nama = $request->nama_depan." ".$request->nama_belakang;

        Siswa::create([
            "name" => $nama,
            "username" => $username_no_space,
            "password" => Hash::make($request->password),
            "password_without_hash" => $request->password,
            "nis" => $request->nis,
            "jurusan_id" => $request->jurusan,
            "kelas_id" => $request->kelas,
            "status" => "active"
        ]);

        return redirect()->back()->with("siswa_created","Berhasil menambah siswa baru!");
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();

        return view("admin.siswa.edit",[
            "title" => 'Edit Siswa',
            "breadcumb_active" => "Edit Siswa",
            "siswa" => $siswa,
            "kelas" => $kelas,
            "jurusan" => $jurusan,
            "web_title" => "Edit Siswa"
        ]);
    }
    
    public function update($id , Request $request)
    {
        if ($request->password==null) {
            $request->validate([
                "nama" => "required",
                "nis" => "required",
                "jurusan" => "required",
                "kelas" => "required"
            ]);

            $siswa = Siswa::findOrFail($id);
            $siswa->update([
                "name" => $request->nama,
                "username" => $request->username,
                "nis" => $request->nis,
                "jurusan" => $request->jurusan,
                "kelas" => $request->kelas
            ]);

        } else {
            $request->validate([
                "nama" => "required",
                "nis" => "required",
                "jurusan" => "required",
                "kelas" => "required",
                "password" => "required|confirmed"
            ]);

            $siswa = Siswa::findOrFail($id);
            $siswa->update([
                "name" => $request->nama,
                "username" => $request->username,
                "nis" => $request->nis,
                "password" => Hash::make($request->password),
                "password_without_hash" => $request->password,
                "jurusan" => $request->jurusan,
                "kelas" => $request->kelas
            ]);
        }

        return redirect()->route("user.siswa")->with("updated","Berhasil mengupdate data siswa!");
        
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->back()->with("deleted","Berhasil menghapus data siswa!");
    }
}
