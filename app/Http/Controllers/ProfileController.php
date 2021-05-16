<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        if (Auth::guard('student')->check()) {
            $siswa_id = Auth::guard('student')->user()->id;
            $siswa = Siswa::findOrFail($siswa_id);
            return view("user.siswa.profile",[
                "siswa" => $siswa
            ]);
        }
        elseif(Auth::guard('teacher')->check()){
            $guru_id = Auth::guard('teacher')->user()->id;
            $guru = Guru::findOrFail($guru_id);
            return view("user.guru.profile",[
                "guru" => $guru
            ]);
        }
    }

    public function edit_guru($id , Request $request)
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
                "password" => "confirmed"
            ]);

            $guru->update([
                "name" => $request->name,
                "username" => $request->username,
                "nip" => $request->nip,
                "password" => Hash::make($request->password),
                "password_without_hash" => $request->password
            ]);
        }
        return redirect()->back()->with("updated","Berhasil mengupdate data user guru");
        
    }

    public function edit_siswa($id,Request $request)
    {
        $siswa = Siswa::findOrFail($id);
        if ($request->password==null) {
            $request->validate([
                "name" => "required",
                "username" => "required",
                "nis" => "required",
            ]);
            $siswa->update([
                "name" => $request->name,
                "username" => $request->username,
                "nis" => $request->nis
            ]);
        } else {
            $request->validate([
                "name" => "required",
                "username" => "required",
                "nis" => "required",
                "password" => "confirmed"
            ]);

            $siswa->update([
                "name" => $request->name,
                "username" => $request->username,
                "nip" => $request->nip,
                "password" => Hash::make($request->password),
                "password_without_hash" => $request->password
            ]);
        }

        return redirect()->back()->with("updated_siswa","Berhasil mengupdate data user siswa");
        
    }
}
