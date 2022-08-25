<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriVOCs;
use App\Models\KuesionerVOCs;

class KuesVOCController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $kuesioner_vocs = new KuesionerVOCs;
        if (request()->has('query')) {
            $q = request()->get('query');
            $kuesioner_vocs = $kuesioner_vocs->where('namkuesvocs', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('id_katvocs')) {
            $q = request()->get('id_katvocs');
            $kuesioner_vocs = $kuesioner_vocs->where('id_katvocs', '=', $q);
        }
        if (request()->has('bobot')) {
            $q = request()->get('bobot');
            $kuesioner_vocs = $kuesioner_vocs->where('bobot', '=', $q);
        }
        if (request()->has('kpd_role')) {
            $q = request()->get('kpd_role');
            $kuesioner_vocs = $kuesioner_vocs->where('kpd_role', '=', $q);
        }
        $kuesioner_vocs = $kuesioner_vocs->get()->pluck('id')->toArray();
        $data = KuesionerVOCs::whereIn('id', $kuesioner_vocs)
            ->with('kategori')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function listKatVOC(){
        return response()->json(KategoriVOCs::select('id', 'namkat_vocs')->get());
    }
    public function listKuesVOC(){
        return response()->json(KuesionerVOCs::select('id', 'namkuesvocs', 'bobot', 'kpd_role')->orderBy('id', 'DESC')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_katvocs' => 'required|numeric',
            'namkuesvocs' => 'required|min:1|max:255|unique:kuesioner_vocs,namkuesvocs',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner VOCs maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner VOCs minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kuesioner VOCs sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_vocs = new KuesionerVOCs;
            $kuesioner_vocs->id_katvocs = $request->id_katvocs;
            $kuesioner_vocs->namkuesvocs = $request->namkuesvocs;
            $kuesioner_vocs->bobot = $request->bobot;
            $kuesioner_vocs->kpd_role = $request->kpd_role;
            $kuesioner_vocs->status_kuesioner = $request->status_kuesioner;
            $kuesioner_vocs->save();
            return $this->showData($kuesioner_vocs);
        }
    }

    public function showDetail($id)
    {
        $kuesioner_vocs = KuesionerVOCs::with('kategori')->find($id);
        return $this->showData($kuesioner_vocs);
    }

    public function update(Request $request, $id)
    {
        $kuesioner_vocs = KuesionerVOCs::find($id);
        $validator = Validator::make($request->all(), [
            'id_katvocs' => 'required|numeric',
            'namkuesvocs' => 'required|min:1|max:255',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner VOCs maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner VOCs minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_vocs->id_katvocs = $request->id_katvocs;
            $kuesioner_vocs->namkuesvocs = $request->namkuesvocs;
            $kuesioner_vocs->bobot = $request->bobot;
            $kuesioner_vocs->kpd_role = $request->kpd_role;
            $kuesioner_vocs->status_kuesioner = $request->status_kuesioner;
            $kuesioner_vocs->save();
        }

        return $this->showData($kuesioner_vocs);
    }

    public function delete($id)
    {
        $data = KuesionerVOCs::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KuesionerVOCs::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus"; 
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
