<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\PeriodePenilaian;

class PeriodePenilaianController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(){
        $periode_penilaian = new PeriodePenilaian();
        if (request()->has('bulan')) {
            $q = request()->get('bulan');
            $periode_penilaian = $periode_penilaian->where('bulan','=',$q);
        }
        if (request()->has('tahun')) {
            $q = request()->get('tahun');
            $periode_penilaian = $periode_penilaian->where('tahun','=',$q);
        }
        if (request()->has('periode')) {
            $q = request()->get('periode');
            $periode_penilaian = $periode_penilaian->where('periode','=',$q);
        }
        if (request()->has('status')) {
            $q = request()->get('status');
            $periode_penilaian = $periode_penilaian->where('status','=',$q);
        }
        $periode_penilaian = $periode_penilaian->get()->pluck('id')->toArray();
        $data = PeriodePenilaian::whereIn('id', $periode_penilaian)
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function listPeriode(){
        return response()->json(PeriodePenilaian::select('bulan','tahun','periode')->orderBy('id', 'DESC')->get());
    }

    // Lihat Detail berdasarkan status
    public function showDetail($id){
        $data = PeriodePenilaian::find($id);
        return $this->showData($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'periode' => 'required|numeric',
            'waktu_terbit' => 'required|date',
            'waktu_penutupan' => 'required|date|after_or_equal:waktu_terbit',
            'status' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $periode_penilaian = new PeriodePenilaian;
            $periode_penilaian->bulan = $request->bulan;
            $periode_penilaian->tahun = $request->tahun;
            $periode_penilaian->periode = $request->periode;
            $periode_penilaian->waktu_terbit = $request->waktu_terbit;
            $periode_penilaian->waktu_penutupan = $request->waktu_penutupan;
            $periode_penilaian->status = $request->status;

            $periode_penilaian->save();
            return $this->showData($periode_penilaian);
        }
    }

    public function update(Request $request, $id){
        $periode_penilaian = PeriodePenilaian::find($id);
        $validator = Validator::make($request->all(), [
            'bulan' => 'required|numeric',
            'tahun' => 'required|numeric',
            'periode' => 'required|numeric',
            'waktu_terbit' => 'required|date',
            'waktu_penutupan' => 'required|date|after_or_equal:waktu_terbit',
            'status' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $periode_penilaian->bulan = $request->bulan;
            $periode_penilaian->tahun = $request->tahun;
            $periode_penilaian->periode = $request->periode;
            $periode_penilaian->waktu_terbit = $request->waktu_terbit;
            $periode_penilaian->waktu_penutupan = $request->waktu_penutupan;
            $periode_penilaian->status = $request->status;

            $periode_penilaian->save();
        }

        return $this->showData($periode_penilaian);
    }

    public function delete($id){
        $data = PeriodePenilaian::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            PeriodePenilaian::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
