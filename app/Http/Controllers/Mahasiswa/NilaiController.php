<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NilaiController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('mahasiswa_tbl.nim', '=', Auth::user()->username)
            ->join('users', 'users.username', '=', 'mahasiswa_tbl.nim')
            ->join('prodi_tbl', 'prodi_tbl.id', '=', 'mahasiswa_tbl.id_prodi')
            ->join('ppl_tbl', 'ppl_tbl.id', '=', 'mahasiswa_tbl.id_lowongan_ppl')
            ->join('sekolah_tbl', 'sekolah_tbl.id', '=', 'ppl_tbl.id_sekolah')

            ->select(
                'users.name as nama_mahasiswa',
                'mahasiswa_tbl.id as id_mahasiswa',
                'ppl_tbl.name as nama_lowongan',
                'sekolah_tbl.name as nama_sekolah',
                'prodi_tbl.name as nama_prodi',
                'mahasiswa_tbl.nilai_pamong',
                'mahasiswa_tbl.nilai_supervisor_ppl',
                'mahasiswa_tbl.nim',
                'mahasiswa_tbl.no_hp_wa',
                'users.name as nama_supervisor'
            )
            ->get();
        return Inertia::render('Mahasiswa/Nilai', [
            'mahasiswa' => $mahasiswa
        ]);
    }
}
