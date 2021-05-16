<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignedTaskController extends Controller
{
    public function index()
    {
        return view("user.guru.assigned_task");
    }
}
