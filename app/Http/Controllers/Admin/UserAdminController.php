<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view("admin.user_admin.list_admin",[
            "title" => "Data User Admin",
            "breadcumb_active" => "User Admin",
            "admins" => $admins,
            "web_title" => "List Admin"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => 'required',
            "username" => "required",
            "password" => "required"
        ]);

        Admin::create([
            "name" => $request->nama,
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "password_without_hash" => $request->password,
            "status" => "Active"
        ]);

        return redirect()->back()->with("created_admin","Berhasil membuat user admin!");
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view("admin.user_admin.edit",[
            "title" => "Edit Admin",
            "breadcumb_active" => "Edit Admin",
            "admin" => $admin,
            "web_title" => "Edit Admin"
        ]);
    }

    public function update($id,Request $request)
    {
        $admin = Admin::findOrFail($id);
        if ($request->password==null) {
            $request->validate([
                "name" => "required",
                "username" => "required",
            ]);
            $admin->update([
                "name" => $request->name,
                "username" => $request->username,
            ]);
        }
        else{
            $request->validate([
                "name" => "required",
                "username" => "required",
                "password" => "required|confirmed",
            ]);
            $admin->update([
                "name" => $request->name,
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "password_without_hash" => $request->password,
                "nip" => $request->nip
            ]);
        }

        return redirect()->route("user.admin")->with("updated","Berhasil mengupdate Guru");
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with("deleted","Berhasil menghapus Admin");
    }
}
