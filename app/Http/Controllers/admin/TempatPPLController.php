<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TempatPPLImport;
use App\Models\LamaranPPL;
use App\Models\LowonganPPL;
use App\Models\Sekolah;
use App\Models\TempatPPL;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class TempatPPLController extends Controller
{
    public function index(Request $request)
    {
        // $daftartempatppl = Sekolah::leftjoin('users', 'users.username', '=', 'sekolah_tbl.username_supervisor')
        //     ->select('sekolah_tbl.id', 'sekolah_tbl.name as nama_sekolah', 'users.name')
        //     ->get();
        $daftartempatppl = Sekolah::with('supervisor')->get();

        return Inertia::render('Admin/pages/PPL/tempatppl/ListTempatPPL', ['daftartempatppl' => $daftartempatppl]);
    }
    public function add()
    {
        return Inertia::render('Admin/pages/PPL/tempatppl/AddTempatPPL');
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'regency' => 'required',
            'sub_district' => 'required',
            'village' => 'required'



        ]);
        // dd($validated);
        Sekolah::create($validated);
        return redirect('/admin/daftartempatppl');
    }


    public function import()
    {
        return Inertia::render('Admin/pages/PPL/tempatppl/ImportTempatPPL');
    }

    public function importtempatppl(Request $request)
    {
        Excel::import(new TempatPPLImport, $request->file('daftartempatppl'));
        return redirect()->route('admin.daftartempatppl');
    }

    public function edit($id)
    {
        $tempatppl = Sekolah::find($id);
        $supervisor = User::where('users.role', 'supervisor')->select('users.username', 'users.name')->get();
        return Inertia::render('Admin/pages/PPL/tempatppl/EditTempatPPL', [
            'supervisordata' => $supervisor,
            'tempatppl' => $tempatppl
        ]);
    }

    public function detail($id)
    {
        $sekolah = Sekolah::where('id', $id)->with(['supervisor'])->first();
        $pelamar = LamaranPPL::where('id_lowongan_ppl', $id)->with(['user', 'data_user', 'data_user.prodi'])->get();
        $daftarlowonganppl = LowonganPPL::with('sekolah')->withCount('accepted_pelamar')->get();


        return Inertia::render('Admin/pages/PPL/tempatppl/DetailTempatPPL', [
            'sekolah' => $sekolah,
            'pelamar' => $pelamar,
            'lowongan' => $daftarlowonganppl


        ]);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'username_supervisor' => $request->username_supervisor,
            'regency' => $request->regency,
            'sub_district' => $request->sub_district,
            'village' => $request->village,

        ];

        $sekolah = Sekolah::find($id);
        $result = $sekolah->update($data);
        if ($result) {
            return redirect('/admin/daftartempatppl')->with('message', ['success' => 'Data Sekolah Berhasil Diupdate']);
        }
        return redirect('/admin/daftartempatppl')->with('message', ['error' => 'Terjadi Kesalahan']);
    }

    public function delete($id)
    {

        $sekolah = Sekolah::find($id);
        $sekolah->delete();
        return redirect()->back();
    }
}
