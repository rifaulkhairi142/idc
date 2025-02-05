<?php

namespace App\Http\Controllers\SupervisorKPM;

use App\Http\Controllers\Controller;
use App\Models\TempatKPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function index()
    {

        $kelas = TempatKPM::where('username_supervisor', Auth::user()->username)->get();
        return Inertia::render(
            'SupervisorKPM/Classroom/Home',
            ['kelas' => $kelas]
        );
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
