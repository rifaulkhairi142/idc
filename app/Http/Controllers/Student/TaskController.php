<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function detail(Request $request)
    {
        return Inertia::render('Mahasiswa/Classroom/DetailTask', ['base_url' => url('/')]);
    }
}
