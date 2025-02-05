<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempatKPM;
use App\Models\User;
use App\Http\Resources\AnggotaResource;
use App\Models\LamaranKPM;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function anggota($id)
    {
        try {
            $kelas = TempatKPM::findOrFail($id);
            if (!$kelas) {
                return new AnggotaResource(false, 'Kelas tidak ditemukan', 404);
            }
            $supervisor = User::where('username', $kelas->username_supervisor)
            ->where('role', 'supervisor_kpm')->get();

            $mahasiswa = LamaranKPM::with(['pelamar' => function ($query) {
                $query->where('role', 'mahasiswa');
            }])->where('id_tempat_kpm', $id)->where('status', 'accepted')->get();

            // Menggabungkan data supervisor dan mahasiswa
            $data = [
                'supervisor' => $supervisor,
                'mahasiswa' => $mahasiswa
            ];

            return new AnggotaResource(true, 'List data anggota', $data);
        } catch (\Exception $e) {
            return new AnggotaResource(false, $e->getMessage(), $e->getCode());
        }
    }
}
