<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LamaranKPM;
use App\Models\Task_submission;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\SubmissionResource;

class MahasiswaKPMController extends Controller
{
    public function all()
    {
        $daftarmahasiswakpm = LamaranKPM::where('status', 'accepted')
            ->with(['kpm', 'pelamar', 'pelamar.dataMahasiswa', 'pelamar.dataMahasiswa.prodi'])
            ->get();
        return Inertia::render('Admin/pages/KPM/ListMahasiswaKPM', ['daftarmahasiswakpm' => $daftarmahasiswakpm]);
    }

    public function getScoreTaskSubmissions()
    {
        try {
            $score = Task_submission::with(['mahasiswa:username,name','tugas:id,name'])->get();
            return new SubmissionResource(true, 'List Score Tugas Mahasiswa', $score);
        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }
}
