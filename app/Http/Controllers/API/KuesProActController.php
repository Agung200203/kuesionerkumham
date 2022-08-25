<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriProAct;
use App\Models\KuesionerProAct;

class KuesProActController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $kuesioner_proact = new KuesionerProAct;
        if (request()->has('query')) {
            $q = request()->get('query');
            $kuesioner_proact = $kuesioner_proact->where('namkuesproacts', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('id_katproacts')) {
            $q = request()->get('id_katproacts');
            $kuesioner_proact = $kuesioner_proact->where('id_katproacts', '=', $q);
        }
        if (request()->has('bobot')) {
            $q = request()->get('bobot');
            $kuesioner_proact = $kuesioner_proact->where('bobot', '=', $q);
        }
        if (request()->has('kpd_role')) {
            $q = request()->get('kpd_role');
            $kuesioner_proact = $kuesioner_proact->where('kpd_role', '=', $q);
        }
        $kuesioner_proact = $kuesioner_proact->get()->pluck('id')->toArray();
        $data = KuesionerProAct::whereIn('id', $kuesioner_proact)
            ->with('kategori')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function listKatProAct(){
        return response()->json(KategoriProAct::select('id', 'namkat_proact')->get());
    }
    public function listKuesProAct()
    {
        return response()->json(KuesionerProAct::select('id', 'namkuesproacts', 'bobot', 'kpd_role')->orderBy('id', 'DESC')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_katproacts' => 'required|numeric',
            'namkuesproacts' => 'required|min:1|max:255|unique:kuesioner_proact,namkuesproacts',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner ProAct maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner ProAct minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kuesioner ProAct sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_proact = new KuesionerProAct;
            $kuesioner_proact->id_katproacts = $request->id_katproacts;
            $kuesioner_proact->namkuesproacts = $request->namkuesproacts;
            $kuesioner_proact->bobot = $request->bobot;
            $kuesioner_proact->kpd_role = $request->kpd_role;
            $kuesioner_proact->status_kuesioner = $request->status_kuesioner;
            $kuesioner_proact->save();
            return $this->showData($kuesioner_proact);
        }
    }

    public function showDetail($id)
    {
        $kuesioner_proact = KuesionerProAct::with('kategori')->find($id);
        return $this->showData($kuesioner_proact);
    }

    public function update(Request $request, $id)
    {
        $kuesioner_proact = KuesionerProAct::find($id);
        $validator = Validator::make($request->all(), [
            'id_katproacts' => 'required|numeric',
            'namkuesproacts' => 'required|min:1|max:255',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner ProAct maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner ProAct minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_proact->id_katproacts = $request->id_katproacts;
            $kuesioner_proact->namkuesproacts = $request->namkuesproacts;
            $kuesioner_proact->bobot = $request->bobot;
            $kuesioner_proact->kpd_role = $request->kpd_role;
            $kuesioner_proact->status_kuesioner = $request->status_kuesioner;
            $kuesioner_proact->save();
        }

        return $this->showData($kuesioner_proact);
    }

    public function delete($id)
    {
        $data = KuesionerProAct::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KuesionerProAct::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
