<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task_submission;
use App\Http\Resources\SubmissionResource;

class SubmissionController extends Controller
{

    public function createTaskSubmissions(Request $request){ 
        try {
            $data = Task_submission::create([
                'username_mahasiswa' => $request->username_mahasiswa,
                'id_kelas' => $request->id_kelas,
                'id_tugas' => $request->id_tugas,
                'link' => $request->link,
                'status' => $request->status,
                'score' => $request->score,
            ]);
            return new SubmissionResource(true, 'Submission Berhasil dibuat!', $data);

        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function editTaskSubmissions(Request $request){
        try {

            $data = [
                'username_mahasiswa' => $request->username_mahasiswa,
                'id_kelas' => $request->id_kelas,
                'id_tugas' => $request->id_tugas,
                'link' => $request->link,
                'status' => $request->status,
                'score' => $request->score,
            ];

            $submission = Task_submission::where('id_kelas', $request->id_kelas)
            ->where('id_tugas', $request->id_tugas)
            ->where('username_mahasiswa', $request->username_mahasiswa)
            ->first();

            if ($submission) {
                // Update data user
                $submission->update($data);
        
                // Response sukses
                return new SubmissionResource(true, 'Submission Berhasil diedit', $submission);
            }

            return new SubmissionResource(true, 'Submission Tidak Ditemukan!', null);

        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function deleteTaskSubmissions(Request $request){
        try {
            $data = Task_submission::where('id_kelas', $request->id_kelas)
            ->where('id_tugas', $request->id_tugas)
            ->where('username_mahasiswa', $request->username_mahasiswa)
            ->first();
            if ($data) {
                $result = $data->delete();
                if ($result) {
                    return new SubmissionResource(true, 'Berhasil Menghapus Submission', null);
                }
            }
            return new SubmissionResource(false, 'Gagal Menghapus Submission', null);

        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function getTaskSubmissions(Request $request)
    {
        try {
            $query = Task_submission::select('id', 'username_mahasiswa', 'id_kelas', 'id_tugas', 'link', 'status', 'score');

            // Filter berdasarkan id_kelas (jika diberikan)
            if ($request->has('id_kelas')) {
                $query->where('id_kelas', $request->id_kelas);
            }

            // Filter berdasarkan id_tugas (jika diberikan)
            if ($request->has('id_tugas')) {
                $query->where('id_tugas', $request->id_tugas);
            }

            // Filter berdasarkan username_mahasiswa (jika diberikan)
            if ($request->has('username_mahasiswa')) {
                $query->where('username_mahasiswa', $request->username_mahasiswa);
            }

            $submissions = $query->get();

            if ($submissions->isEmpty()) {
                return new SubmissionResource(false, 'Data tidak ditemukan!', 404);
            }

            return new SubmissionResource(true, 'Data Submission!', $submissions);
            
        } catch (\Exception $e) {
            return new SubmissionResource(false, $e->getMessage(), $e->getCode());
        }
    }
}
