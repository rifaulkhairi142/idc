<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SupervisorImport;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;


class SupervisorController extends Controller
{
    public function index(Request $request)
    {
        $daftarsupervisor = User::select('users.id', 'users.name', 'users.username',)
            ->where('users.role', '=', 'supervisor')->get();
        return Inertia::render('Admin/pages/Pengguna/Supervisor/ListSupervisor', ['daftarsupervisor' => $daftarsupervisor]);
    }
    public function import()
    {
        return Inertia::render('Admin/pages/Pengguna/Supervisor/ImportSupervisor');
    }

    public function importsupervisor(Request $request)
    {
        Excel::import(new SupervisorImport, $request->file('daftarsupervisor'));
        return redirect()->route('admin.daftarsupervisor');
    }

    public function delete($id)
    {
        // dd($id);
        $supervisor = User::find($id);
        if ($supervisor) {
            $result = $supervisor->delete();
            if ($result) {
                return redirect()->back()->with('message', ['success' => 'Berhasil Menghapus Supervisor']);
            }
        }
        return redirect()->back()->with('message', ['error' => 'Gagal Menghapus Supervisor']);
    }

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function tambah(Request $request)
    {
        // return 'fuck';
        // dd($request);
        return Inertia::render('Admin/pages/Pengguna/Supervisor/AddSupervisor');
    }

    public function save(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'role' => 'supervisor',
        ];

        $user = User::create($data);
        if ($user) {
            return redirect('/admin/daftarsupervisor')->with('message', ['success' => 'Supervisor Berhasil ditambahkan']);
        }
        return redirect('/admin/daftarsupervisor')->with('message', ['success' => 'Supervisor Berhasil ditambahkan']);
    }
}
