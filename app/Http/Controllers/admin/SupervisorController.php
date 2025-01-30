<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SupervisorImport;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\SupervisorResource;


class SupervisorController extends Controller
{
    public function index(Request $request)
    {
        $daftarsupervisor = User::select('users.id', 'users.name', 'users.username',)
            ->where('users.role', '=', 'supervisor')->get();
        // return Inertia::render('Admin/pages/Pengguna/Supervisor/ListSupervisor', ['daftarsupervisor' => $daftarsupervisor]);
        return new SupervisorResource(true, 'List Supervisor', $daftarsupervisor);
    }
    public function import()
    {
        return Inertia::render('Admin/pages/Pengguna/Supervisor/ImportSupervisor');
    }

    public function importsupervisor(Request $request)
    {
        $import = Excel::import(new SupervisorImport, $request->file('daftarsupervisor'));
        // return redirect()->route('admin.daftarsupervisor');
        return new SupervisorResource(true, 'Berhasil Import Data Supervisor', $import);
    }

    public function delete($id)
    {
        // dd($id);
        $supervisor = User::find($id);
        if ($supervisor) {
            $result = $supervisor->delete();
            if ($result) {
                // return redirect()->back()->with('message', ['success' => 'Berhasil Menghapus Supervisor']);
                return new SupervisorResource(true, 'Berhasil Menghapus Supervisor', null);
            }
        }
        // return redirect()->back()->with('message', ['error' => 'Gagal Menghapus Supervisor']);
        return new SupervisorResource(false, 'Gagal Menghapus Supervisor', null);
    }

    public function edit($id) {}

    public function update(Request $request, $id) {   
        // Data yang akan diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Hash password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Cari user berdasarkan ID
        $user = User::find($id);

        if ($user) {
            // Update data user
            $user->update($data);
    
            // Response sukses
            return new SupervisorResource(true, 'Supervisor Berhasil diupdate', $user);
        }
    
        // Jika user tidak ditemukan
        return new SupervisorResource(false, 'Supervisor tidak ditemukan', null);
    }
    
    public function show($id)
    {
        //find post by ID
        $user = User::find($id);

        //return single User as a resource
        return new SupervisorResource(true, 'Detail Data User!', $user);
    }

    public function tambah(Request $request)
    {
        
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
            'role' => $request->role,
        ];
        
        $user = User::create($data);
        if ($user) {
            // return redirect('/admin/daftarsupervisor')->with('message', ['success' => 'Supervisor Berhasil ditambahkan']);
            return new SupervisorResource(true, 'Supervisor Berhasil ditambahkan', $user);
        }
        // return redirect('/admin/daftarsupervisor')->with('message', ['success' => 'Supervisor Berhasil ditambahkan']);
        return new SupervisorResource(false, 'Supervisor gagal ditambahkan', null);
    }
}
