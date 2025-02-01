<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task_submission;
use App\Models\Task;
use App\Models\TempatKPM;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function createTasksByClass(Request $request){ 
        try {
            $task = Task::create([
                'name' => $request->name,
                'tenggat' => $request->tenggat,
                'tipe' => $request->tipe,
            ]);
            return new TaskResource(true, 'Tugas Berhasil dibuat!', $task);

        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function editTasksByClass(Request $request, $id){
        try {

            $task = [
                'name' => $request->name,
                'tenggat' => $request->tenggat,
                'tipe' => $request->tipe,
            ];

            $data = Task::find($id);

            if ($data) {
                // Update data user
                $data->update($task);
        
                // Response sukses
                return new TaskResource(true, 'Tugas Berhasil diedit', $data);
            }

            return new TaskResource(true, 'Tugas Tidak Ditemukan!', null);

        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function deleteTasksByClass($id){
        try {
            $task = Task::find($id);
            if ($task) {
                $result = $task->delete();
                if ($result) {
                    return new TaskResource(true, 'Berhasil Menghapus Tugas', null);
                }
            }
            return new TaskResource(false, 'Gagal Menghapus Tugas', null);

        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function getTasksByClass($id){
        
        try {
            $data_kelas = TempatKPM::where('id', $id)
            ->selectRaw(
                'tempat_kpm_tbl.id,
                tempat_kpm_tbl.name'
            )
            ->first();

            $data_kelas['tasks'] = Task::paginate(10);
        
            if (!$data_kelas) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
                return new TaskResource(true, 'Data tidak ditemukan', 404);
            }
        
            return new TaskResource(true, 'List Data', $data_kelas);
            
        
        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
        }
        
    }

    public function getTaskDetails($id_kelas, $id_tugas)
    {
        try {
            $data_tugas = TempatKPM::where('id', $id_kelas)
            ->selectRaw(
                'tempat_kpm_tbl.id,
                tempat_kpm_tbl.name'
            )
            ->first();

            
            if ($data_tugas) {
                $data_tugas['tasks'] = Task::where('id', $id_tugas)->first();
            }else{
                return new TaskResource(true, 'Data tidak ditemukan', 404);
            }
        
            return new TaskResource(true, 'List Data', $data_tugas);
            
        
        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
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
                return new TaskResource(false, 'Data tidak ditemukan!', 404);
            }

            return new TaskResource(true, 'Data Submission!', $submissions);
            
        } catch (\Exception $e) {
            return new TaskResource(false, $e->getMessage(), $e->getCode());
        }
    }

    public function detail(Request $request)
    {
        return Inertia::render('Mahasiswa/Classroom/DetailTask', ['base_url' => url('/')]);
    }
}
