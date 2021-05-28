<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserGuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view("admin.guru.list_guru",[
            "title" => "User Guru",
            "breadcumb_active" => "Data User Guru",
            "guru" => $guru,
            "web_title" => 'List Guru'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_depan" => "required",
            "nama_belakang" => "required",
            "nip" => "required",
            "password" => "required"
        ]);
        
        $lower = strtolower($request->nama_depan);
        $username = $lower."".rand(10000,20000);
        $username_no_space = str_replace(" ","",$username);
        $nama = $request->nama_depan." ".$request->nama_belakang;

        Guru::create([
            "name" => $nama,
            "username" => $username_no_space,
            "password" => Hash::make($request->password),
            "password_without_hash" => $request->password,
            "nip" => $request->nip,
            "status" => "active"
        ]);

        return redirect()->back()->with("success_create","Berhasil tambah guru");
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view("admin.guru.edit_guru",[
            "title" => "Edit Guru",
            "breadcumb_active" => "Edit Guru",
            "guru" => $guru,
            "web_title" => "Edit Guru"
        ]);
    }

    public function update($id , Request $request)
    {
        $guru = Guru::findOrFail($id);
        if ($request->password==null) {
            $request->validate([
                "name" => "required",
                "username" => "required",
                "nip" => "required",
            ]);
            $guru->update([
                "name" => $request->name,
                "username" => $request->username,
                "nip" => $request->nip
            ]);
        }
        else{
            $request->validate([
                "name" => "required",
                "username" => "required",
                "nip" => "required",
                "password" => "required|confirmed",
            ]);
            $guru->update([
                "name" => $request->name,
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "password_without_hash" => $request->password,
                "nip" => $request->nip
            ]);
        }

       return redirect()->route("user.guru")->with("updated","Berhasil mengupdate Guru");
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->back()->with("deleted","Berhasil menghapus guru");
    }
}
