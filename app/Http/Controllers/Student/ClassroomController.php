<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LamaranKPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class ClassroomController extends Controller
{
    public function home()
    {
        $data = LamaranKPM::join('tempat_kpm_tbl as t_kpm', 'lamaran_kpm_tbl.id_tempat_kpm', '=', 't_kpm.id')
            ->select('t_kpm.name as nama_tempat', 't_kpm.id')
            ->where('username_mahasiswa', Auth::user()->username)
            ->where('status', 'accepted')
            ->first();


        return Inertia::render(
            'Mahasiswa/ClassroomKPM',
            [
                'data' => $data
            ]

        );
    }

    public function tasks($id)
    {
        return Inertia::render('Mahasiswa/Classroom/Home', [
            'base_url' => url('/'),
            'id' => $id
        ]);
    }

    public function detail_tugas(Request $request, $id_kelas, $id_tugas)
    {
        return Inertia::render('Mahasiswa/Classroom/DetailTask', [
            'base_url' => url('/'),
            'data' => [
                'id_kelas' => $id_kelas,
                'id_tugas' => $id_tugas
            ]
        ]);
    }
}
