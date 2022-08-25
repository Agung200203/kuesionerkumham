<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriSpeed;
use App\Models\KuesionerSpeed;

class KuesSpeedController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $kuesioner_speedec = new KuesionerSpeed;
        if (request()->has('query')) {
            $q = request()->get('query');
            $kuesioner_speedec = $kuesioner_speedec->where('namkuesspeed', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('id_katspeed')) {
            $q = request()->get('id_katspeed');
            $kuesioner_speedec = $kuesioner_speedec->where('id_katspeed', '=', $q);
        }
        if (request()->has('bobot')) {
            $q = request()->get('bobot');
            $kuesioner_speedec = $kuesioner_speedec->where('bobot', '=', $q);
        }
        if (request()->has('kpd_role')) {
            $q = request()->get('kpd_role');
            $kuesioner_speedec = $kuesioner_speedec->where('kpd_role', '=', $q);
        }
        $kuesioner_speedec = $kuesioner_speedec->get()->pluck('id')->toArray();
        $data = KuesionerSpeed::whereIn('id', $kuesioner_speedec)
            ->with('kategori')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function listKatSpeed(){
        return response()->json(KategoriSpeed::select('id', 'namkat_speed')->get());
    }
    public function listKuesSpeed()
    {
        return response()->json(KuesionerSpeed::select('id', 'namkuesspeed', 'bobot', 'kpd_role')->orderBy('id', 'DESC')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_katspeed' => 'required|numeric',
            'namkuesspeed' => 'required|min:1|max:255|unique:kuesioner_speedec,namkuesspeed',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner Speedec maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner Speedec minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kuesioner Speedec sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_speedec = new KuesionerSpeed;
            $kuesioner_speedec->id_katspeed = $request->id_katspeed;
            $kuesioner_speedec->namkuesspeed = $request->namkuesspeed;
            $kuesioner_speedec->bobot = $request->bobot;
            $kuesioner_speedec->kpd_role = $request->kpd_role;
            $kuesioner_speedec->status_kuesioner = $request->status_kuesioner;
            $kuesioner_speedec->save();
            return $this->showData($kuesioner_speedec);
        }
    }

    public function showDetail($id)
    {
        $kuesioner_speedec = KuesionerSpeed::with('kategori')->find($id);
        return $this->showData($kuesioner_speedec);
    }

    public function update(Request $request, $id)
    {
        $kuesioner_speedec = KuesionerSpeed::find($id);
        $validator = Validator::make($request->all(), [
            'id_katspeed' => 'required|numeric',
            'namkuesspeed' => 'required|min:1|max:255',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner Speedec maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner Speedec minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_speedec->id_katspeed = $request->id_katspeed;
            $kuesioner_speedec->namkuesspeed = $request->namkuesspeed;
            $kuesioner_speedec->bobot = $request->bobot;
            $kuesioner_speedec->kpd_role = $request->kpd_role;
            $kuesioner_speedec->status_kuesioner = $request->status_kuesioner;
            $kuesioner_speedec->save();
        }

        return $this->showData($kuesioner_speedec);
    }

    public function delete($id)
    {
        $data = KuesionerSpeed::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KuesionerSpeed::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
