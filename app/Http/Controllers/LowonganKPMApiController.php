<?php

namespace App\Http\Controllers;

use App\Models\TempatKPM;
use Illuminate\Http\Request;

class LowonganKPMApiController extends Controller
{
    public function index(Request $request)
    {
        $query = TempatKPM::query();

        if ($request->has('regency') && !empty($request->regency)) {
            $query->where('regency', $request->regency);
        }
        if ($request->has('sub_district') && !empty($request->sub_district)) {
            $query->where('sub_district', $request->sub_district);
        }
        if ($request->has('village') && !empty($request->village)) {
            $query->where('village', $request->village);
        }

        $data = $query->paginate(10);

        return response()->json($data);
    }
}
