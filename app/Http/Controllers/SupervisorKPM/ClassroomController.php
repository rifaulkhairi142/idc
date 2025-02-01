<?php

namespace App\Http\Controllers\SupervisorKPM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function index()
    {
        return Inertia::render('SupervisorKPM/Classroom/Home');
    }

    public function viewTask()
    {
        return Inertia::render('SupervisorKPM/Classroom/ViewKelas');
    }

    public function detail()
    {
        return Inertia::render('SupervisorKPM/Classroom/DetailTask');
    }

    public function tugasMahasiswa()
    {
        return Inertia::render('SupervisorKPM/Classroom/TugasMahasiswa', [
            'base_url' => url('/'),
        ]);
    }
}
