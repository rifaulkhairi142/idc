<?php

namespace App\Http\Controllers;

use App\Models\LowonganPPL;
use App\Models\Mahasiswa;
use App\Models\Sekolah;
use App\Models\TempatPPL;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [];
        $data['pengguna'] = ModelsUser::all()->count();
        $data['sekolah'] = Sekolah::all()->count();
        $data['lowongan'] = LowonganPPL::all()->count();
        $data['mahasiswappl'] = Mahasiswa::all()->count();
        $data['recapperprodi'] = Mahasiswa::join('prodi_tbl', 'prodi_tbl.id', '=', 'mahasiswa_tbl.id_prodi')
            ->select('mahasiswa_tbl.id_prodi', DB::raw('count(*) as total'), 'prodi_tbl.name as nama_prodi')
            ->groupBy('mahasiswa_tbl.id_prodi', 'prodi_tbl.name')  // Include prodi_tbl.name in the groupBy clause
            ->get();

        $data['supervisor'] = ModelsUser::where('users.role', '=', 'supervisor')->count();
        $data['nilaikosong'] = Mahasiswa::whereNull('nilai_supervisor_ppl')
            ->orWhereNull('nilai_pamong')
            ->orWhereNull('link_instrument_penilaian')
            ->count();



        return Inertia::render('Admin/Dashboard', ['data' => $data]);
    }
}
