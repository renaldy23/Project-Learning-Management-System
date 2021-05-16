<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view("auth/login");
    }

    public function login(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required"
        ]);


        if (Auth::guard('student')->attempt(["username" => $request->username , "password" => $request->password])) {
            $siswa_id = Auth::guard('student')->user()->id;
            $siswa = Siswa::find($siswa_id);
            $siswa->update([
                "status" => "online"
            ]);
            return redirect()->route("dashboard.siswa");
        }
        elseif(Auth::guard('teacher')->attempt(["username" => $request->username , "password" => $request->password])){
            $guru_id = Auth::guard('teacher')->user()->id;
            $guru = Guru::find($guru_id);
            $guru->update([
                "status" => "online"
            ]);
            return redirect()->route("dashboard.guru");
        }
        elseif(Auth::guard('admin')->attempt(["username" => $request->username , "password" => $request->password])){
            return redirect()->route("admin.dashboard");
        }
        else{
            return redirect()->back()->with("error","Username atau password salah");
        }
    }

    public function logout()
    {
        if (Auth::guard("student")->check()) {
            $siswa_id = Auth::guard('student')->user()->id;
            $siswa = Siswa::find($siswa_id);
            $siswa->update([
                "status" => "offline",
                "last_online" => date("Y-m-d H:i:s")
            ]);
            Auth::guard("student")->logout();
        }
        elseif(Auth::guard("teacher")->check()){
            $guru_id = Auth::guard('teacher')->user()->id;
            $guru = Guru::find($guru_id);
            $guru->update([
                "status" => "offline",
                "last_online" => date("Y-m-d H:i:s")
            ]);
            Auth::guard("teacher")->logout();
        }
        elseif(Auth::guard('admin')->check()){
            Auth::guard("admin")->logout();
        }
        return redirect()->route("login.form");
    }
}
