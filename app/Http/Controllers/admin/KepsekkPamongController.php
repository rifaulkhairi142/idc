<?php

namespace App\Http\Controllers\Admin;

use App\Exports\KepsekPamongExport;
use App\Http\Controllers\Controller;
use App\Models\AmprahamPPL;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class KepsekkPamongController extends Controller
{

    public function detail($id)
    {
        $data = AmprahamPPL::join('sekolah_tbl as s_tbl', 'ampraham_ppl_tbl.id_sekolah', '=', 's_tbl.id')
            ->select('s_tbl.name as nama_sekolah', 'ampraham_ppl_tbl.*')
            ->where('ampraham_ppl_tbl.id', $id)
            ->first();
        return Inertia::render('Admin/pages/Data/KepsekPamong/Detail', ['data' => $data, 'base_url' => url('/')]);
    }
    public function export()
    {
        return Excel::download(new KepsekPamongExport, 'data_kepsek_pamong.xlsx');
    }
    public function list()
    {
        return Inertia::render('Admin/pages/Data/KepsekPamong/List', ['base_url' => url('/')]);
    }
    public function query(Request $request)
    {
        $query = AmprahamPPL::join('sekolah_tbl as s_tbl', 'ampraham_ppl_tbl.id_sekolah', '=', 's_tbl.id');

        if ($request->has('search_key') && !empty($request->search_key)) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('ampraham_ppl_tbl.name', 'like', '%' . $request->search_key . '%')
                    ->orWhere('s_tbl.name', 'like', '%' . $request->search_key . '%');
                // ->orWhere('booking_tbl.student_nim', 'like', '%' . $request->search_key . '%');
            });
        }
        $query->selectRaw(
            'ROW_NUMBER() OVER (ORDER BY ampraham_ppl_tbl.id) AS row_index,
               ampraham_ppl_tbl.*,
                s_tbl.name as nama_sekolah'
        );

        $data = $query->paginate(10);

        return response()->json($data);
    }
    public function delete($id)
    {

        DB::beginTransaction();
        try {
            $ampraham = AmprahamPPL::find($id);

            $link_doc = $ampraham->link_document;
            if (Storage::exists($link_doc)) {
                Storage::delete($link_doc);
            }

            $ampraham->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Record successfully deleted'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
