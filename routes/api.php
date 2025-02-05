<?php

use App\Http\Controllers\Admin\AdminKecamatanController;
use App\Http\Controllers\Admin\AdminSekolahController;
use App\Http\Controllers\Admin\CamatKeuchikController;
use App\Http\Controllers\Admin\KepsekkPamongController;
use App\Http\Controllers\Admin\LowonganPPLController;
use App\Http\Controllers\LowonganKPMApiController;
use App\Http\Controllers\LowonganKPMController;
use App\Http\Controllers\LowonganPPLApiController;
use App\Http\Controllers\OperatorKecamatan\OperatorKecamatanController;
use App\Http\Controllers\OperatorSekolah\OpratorSekolahController;
use App\Http\Controllers\Student\TaskController;
use App\Http\Controllers\Student\CommentController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Student\AnggotaController;
use App\Http\Controllers\Supervisor\SupervisorSubmissionController;
use App\Models\AdminSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SupervisorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lowonganppl', [LowonganPPLApiController::class, 'index']);
Route::get('/lowongankpm', [LowonganKPMApiController::class, 'index']);
Route::post('/admin/admin-sekolah/generate', [AdminSekolahController::class, 'generate']);
Route::get('/admin/admin-sekolah/query', [AdminSekolahController::class, 'query']);
Route::post('/admin/oprator-sekolah/delete/{email}', [AdminSekolahController::class, 'delete']);
Route::post('/admin/oprator-sekolah/bulk-delete', [AdminSekolahController::class, 'bulk_delete']);
Route::post('/admin/oprator-sekolah/export', [AdminSekolahController::class, 'export']);

Route::post('/operator-sekolah/data/kepsek_pamong/save', [AdminSekolahController::class, 'kepsek_pamong_save']);
Route::get('/operator-sekolah/data/kepsek-pamong/query', [OpratorSekolahController::class, 'query']);
Route::post('/operator-sekolah/data/kepsek-pamong/delete/{id}', [OpratorSekolahController::class, 'delete']);
Route::post('/admin/admin-kecamatan/generate', [AdminKecamatanController::class, 'generate']);
Route::get('/admin/data/admin-kecamatan/query', [AdminKecamatanController::class, 'query']);
Route::post('/admin/oprator-kecamatan/bulk-delete', [AdminKecamatanController::class, 'bulk_delete']);
Route::post('/admin/oprator-kecamatan/export', [AdminKecamatanController::class, 'export']);
Route::post('/admin/oprator-kecamatan/delete/{email}', [AdminKecamatanController::class, 'delete']);

Route::get('/operator-kecamatan/data/camat-keuchik/query', [OperatorKecamatanController::class, 'query']);
Route::post('/operator-kecamatan/data/camat-keuchik/save', [OperatorKecamatanController::class, 'camat_keuchik_save']);
Route::post('/operator-kecamatan/data/camat-keuchik/delete/{id}', [OperatorKecamatanController::class, 'delete']);
Route::get('/admin/data/kepsek-pamong/query', [KepsekkPamongController::class, 'query']);
Route::post('/admin/data/kepsek-pamong/delete/{id}', [KepsekkPamongController::class, 'delete']);
Route::post('/admin/data/kepsek-pamong/export', [KepsekkPamongController::class, 'export']);
Route::post('/admin/data/camat-keuchik/export', [CamatKeuchikController::class, 'export']);
Route::get('/admin/data/camat-keuchik/query', [CamatKeuchikController::class, 'query']);
Route::post('/admin/data/camat-keuchik/delete/{id}', [CamatKeuchikController::class, 'delete']);
Route::get('/operator-sekolah/data/mahasiswa', [KepsekkPamongController::class, 'mahasiswa']);
Route::post('/admin/data/kepsek-pamong/update-status/{id}', [KepsekkPamongController::class, 'update_status']);
Route::post('/admin/data/camat-keuchik/update-status/{id}', [CamatKeuchikController::class, 'update_status']);

Route::get('/admin/daftarsupervisor', [SupervisorController::class, 'index']);
Route::post('/admin/daftarsupervisor', [SupervisorController::class, 'save']);
Route::get('/admin/daftarsupervisor/{id}', [SupervisorController::class, 'show']);
Route::put('/admin/daftarsupervisor/{id}', [SupervisorController::class, 'update']);
Route::delete('/admin/daftarsupervisor/{id}', [SupervisorController::class, 'delete']);
Route::post('/admin/importsupervisor', [SupervisorController::class, 'importsupervisor']);
Route::get('/admin/exportsupervisor', [SupervisorController::class, 'exportsupervisor']);

Route::post('/student/classroom/task', [TaskController::class, 'createTasksByClass']);
Route::put('/student/classroom/task/{id}', [TaskController::class, 'editTasksByClass']);
Route::delete('/student/classroom/task/{id}', [TaskController::class, 'deleteTasksByClass']);

Route::get('/student/classroom/{id}/task', [TaskController::class, 'getTasksByClass']);
Route::get('/student/classroom/{id_kelas}/task/{id_task}', [TaskController::class, 'getTaskDetails']);

Route::get('/student/classroom/submission', [SubmissionController::class, 'getTaskSubmissions']);
Route::post('/student/classroom/submission', [SubmissionController::class, 'createTaskSubmissions']);
Route::put('/student/classroom/submission', [SubmissionController::class, 'editTaskSubmissions']);
Route::delete('/student/classroom/submission', [SubmissionController::class, 'deleteTaskSubmissions']);

Route::get('/student/classroom/publiccomment', [CommentController::class, 'getPublicComments']);
Route::post('/student/classroom/publiccomment', [CommentController::class, 'createPublicComment']);

Route::get('/student/classroom/privatecomment', [CommentController::class, 'getPrivateComments']);
Route::post('/student/classroom/privatecomment', [CommentController::class, 'createPrivateComment']);

Route::put('/supervisor/classroom/score', [SupervisorSubmissionController::class, 'scoreTaskSubmissions']);

Route::get('/student/classroom/{id}/anggota', [AnggotaController::class, 'anggota']);