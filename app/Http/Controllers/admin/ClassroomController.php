<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function tugas()
    {
        return Inertia::render('Admin/pages/ClassroomKPM/Tugas/List', [
            'base_url' => url('/')
        ]);
    }

    public function tugas_add()
    {
        return Inertia::render('Admin/pages/ClassroomKPM/Tugas/Add', ['base_url' => url('/')]);
    }

    public function tugas_edit($id)
    {
        return Inertia::render('Admin/pages/ClassroomKPM/Tugas/Edit', [
            'id' => $id,
            'base_url' => url('/')
        ]);
    }
}
