<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SubmissionResource;
use Illuminate\Support\Facades\DB;
use App\Models\Task_submission;
use App\Models\LamaranKPM;

class SupervisorSubmissionController extends Controller
{
    public function getTaskSubmissions($id_kelas, $id_tugas)
    {
        try {

            // Ambil semua mahasiswa yang tergabung dalam kelas
            $mahasiswa = LamaranKPM::where('id_tempat_kpm', $id_kelas)
                ->where('status', 'accepted')
                ->with(['pelamar' => function ($query) {
                    $query->where('role', 'mahasiswa');
                }])
                ->get();

            // Ambil username mahasiswa dari hasil query di atas
            $usernames = $mahasiswa->pluck('username_mahasiswa')->filter()->toArray();

            // Ambil semua tugas yang dikumpulkan oleh mahasiswa
            $taskSubmissions = Task_submission::where('id_tugas', $id_tugas)
                ->whereIn('username_mahasiswa', $usernames)
                ->get()
                ->keyBy('username_mahasiswa');

            $allTaskSubmissions = collect();

            foreach ($mahasiswa as $mhs) {
                $username = $mhs->username_mahasiswa ?? null;
                if (!$username) continue; // Lewati jika tidak memiliki username
            
                if ($taskSubmissions->has($username)) {
                    // Jika mahasiswa sudah memiliki tugas, ambil dari database
                    $allTaskSubmissions->push($taskSubmissions[$username]);
                } else {
                    // Jika belum memiliki tugas, buat data dummy dengan status "ditugaskan"
                    $allTaskSubmissions->push((object) [
                        'id' => null,
                        'username_mahasiswa' => $username,
                        'id_kelas' => $id_kelas,
                        'id_tugas' => $id_tugas,
                        'link' => null, // Belum ada file yang dikumpulkan
                        'status' => 'ditugaskan',
                        'score' => null,
                        'created_at' => null,
                        'updated_at' => null,
                    ]);
                }
            }

            return new SubmissionResource(true, 'List Data', $allTaskSubmissions);
        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function scoreTaskSubmissions(Request $request){
        try {
            DB::beginTransaction();
    
            // Cari submission berdasarkan id_kelas, id_tugas, dan username_mahasiswa
            $submission = Task_submission::where('id_kelas', $request->id_kelas)
                ->where('id_tugas', $request->id_tugas)
                ->where('username_mahasiswa', $request->username_mahasiswa)
                ->first();
    
            if (!$submission) {
                return new SubmissionResource(false, 'Submission tidak ditemukan', 404);
            }
    
            // Update data submission
            $submission->status = $request->status ?? $submission->status;
            $submission->score = $request->score ?? $submission->score;
    
            // Simpan perubahan
            $submission->save();
    
            DB::commit();
    
            return new SubmissionResource(true, 'Tugas berhasil diperbarui', $submission);
        } catch (\Exception $e) {
            DB::rollBack();
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }
}
