<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LamaranKPM;
use App\Models\TempatKPM as ModelsTempatKPM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TempatKPM extends Controller
{
    public function list()
    {
        $tempat_kpm = ModelsTempatKPM::withCount('accepted_pelamar')->get();
        return Inertia::render('Admin/pages/KPM/TempatKPM', ['tempat_kpm' => $tempat_kpm]);
    }

    public function detail_pelamar($id)
    {

        $lamaran = LamaranKPM::where('id', $id)->with(['kpm', 'pelamar', 'data_user', 'data_user.prodi'])->first();
        $tempatkpm = ModelsTempatKPM::withCount('accepted_pelamar')->where('id', $lamaran->kpm->id)->first();
        return Inertia::render('Admin/pages/KPM/FollowUpLamaranKPM', [
            'lamaran' => $lamaran,
            'tempatkpm' => $tempatkpm
        ]);
    }

    public function followup(Request $request, $id)
    {
        $lamaran = LamaranKPM::find($id);
        $data = [
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ];
        // dd($lamaran);

        $lamaran_kpm_user = LamaranKPM::where('username_mahasiswa', $lamaran->username_mahasiswa)
            ->where('id', '!=', $id)
            ->get();


        DB::beginTransaction();
        try {

            if (count($lamaran_kpm_user) > 0 && $data['status'] === 'accepted') {
                foreach ($lamaran_kpm_user as $lamaran_user) {
                    $lamaran_user->delete();
                }
            }
            $lamaran->update($data);


            DB::commit();
            return redirect('/admin/tempatkpm')->with('message', ['success' => 'Berhasil Memperbaharui']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/admin/tempatkpm')->with('message', ['error' => $e->getMessage()]);
        }
    }

    public function add()
    {
        return Inertia::render('Admin/pages/KPM/AddTempatKPM');
    }
    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'regency' => 'required',
            'sub_district' => 'required',
            'village' => 'required',
            'qouta' => 'required|numeric'

        ]);
        ModelsTempatKPM::create($validated);

        return redirect('/admin/tempatkpm');
    }

    public function detail(Request $request, $id)
    {
        $tempat_kpm = ModelsTempatKPM::where('id', $id)->withCount('accepted_pelamar')->first();

        $pelamar = LamaranKPM::where('id_tempat_kpm', $id)->with(['pelamar', 'data_user', 'data_user.prodi'])->get();

        return Inertia::render('Admin/pages/KPM/DetailTempatKPM', [
            'tempat_kpm' => $tempat_kpm,
            'pelamar' => $pelamar,
        ]);
    }

    public function edit($id)
    {
        $tempat_kpm = ModelsTempatKPM::find($id);
        return Inertia::render('Admin/pages/KPM/EditTempatKPM', [
            'tempat_kpm' => $tempat_kpm,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'regency' => 'required',
            'sub_district' => 'required',
            'village' => 'required',
            'qouta' => 'required|numeric'

        ]);
        $tempat_kpm = ModelsTempatKPM::find($id);
        $tempat_kpm->update($validated);
        return redirect('/admin/tempatkpm');
    }
    public function delete($id)
    {
        $tempat = ModelsTempatKPM::find($id);
        $tempat->delete();
        return redirect()->back();
    }
}
