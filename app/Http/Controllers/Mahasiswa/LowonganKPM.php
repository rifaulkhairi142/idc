<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\LamaranKPM;
use App\Models\TempatKPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LowonganKPM extends Controller
{
    public function index($id)
    {
        $tempat_kpm = TempatKPM::where('id', $id)->with(['pelamar', 'pelamar.pelamar', 'pelamar.data_user', 'pelamar.data_user.prodi'])->withCount('accepted_pelamar')->first();


        $pelamar = LamaranKPM::join('tempat_kpm_tbl as t_kpm', 'lamaran_kpm_tbl.id_tempat_kpm', '=', 't_kpm.id')
            ->join('users as us', 'lamaran_kpm_tbl.username_mahasiswa', '=', 'us.username')
            ->join('mahasiswa_tbl as m_t', 'us.username', '=', 'm_t.nim')
            ->join('prodi_tbl as pr', 'm_t.id_prodi', '=', 'pr.id')
            ->where('t_kpm.id', '=', $tempat_kpm->id) // Use id from $tempat_kpm
            ->where('lamaran_kpm_tbl.status', '=', 'accepted')
            ->select("us.name as nama_mahasiswa", 'pr.name as nama_prodi', 'us.username as nim', 'm_t.jk as jk')
            ->get();
        return Inertia::render('Mahasiswa/DetailLowonganKPM', ['tempat_kpm' => $tempat_kpm, 'pelamar' => $pelamar]);
    }

    public function lamar(Request $request)
    {
        $importan_data = Data::all()->first();
        $lamaran_accepted = LamaranKPM::where('username_mahasiswa', Auth::user()->username)->where('status', 'accepted')->first();


        $data = [
            'username_mahasiswa' => Auth::user()->username,
            'status' => 'submitted',
            'id_tempat_kpm' => $request->id,
        ];

        // check apakah sudah pernah lamar sebelumnya
        $result = LamaranKPM::where('id_tempat_kpm', $request->id)->where('username_mahasiswa', Auth::user()->username)->first();


        if ($result) {

            return redirect('/riwayat')->with('message', ['error' => 'Lamaran Sudah Pernah diajukan']);
        } else {
            LamaranKPM::create($data);
            return redirect('/riwayat')->with('message', ['success' => 'Lamaran Berhasil dikirim']);;
        }
    }
}
