<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SubmissionResource;
use Illuminate\Support\Facades\DB;
use App\Models\Task_submission;

class SupervisorSubmissionController extends Controller
{
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
