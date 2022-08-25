<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriXRole;
use App\Models\KuesionerXRole;

class KuesXRoleController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $kuesioner_xrole = new KuesionerXRole;
        if (request()->has('query')) {
            $q = request()->get('query');
            $kuesioner_xrole = $kuesioner_xrole->where('namkuesxrole', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('id_katxrole')) {
            $q = request()->get('id_katxrole');
            $kuesioner_xrole = $kuesioner_xrole->where('id_katxrole', '=', $q);
        }
        if (request()->has('bobot')) {
            $q = request()->get('bobot');
            $kuesioner_xrole = $kuesioner_xrole->where('bobot', '=', $q);
        }
        if (request()->has('kpd_role')) {
            $q = request()->get('kpd_role');
            $kuesioner_xrole = $kuesioner_xrole->where('kpd_role', '=', $q);
        }
        $kuesioner_xrole = $kuesioner_xrole->get()->pluck('id')->toArray();
        $data = KuesionerXRole::whereIn('id', $kuesioner_xrole)
            ->with('kategori')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function listKatXRole(){
        return response()->json(KategoriXRole::select('id', 'namkat_xrole')->get());
    }
    public function listKuesXrole(){
        return response()->json(KuesionerXRole::select('id', 'namkuesxrole', 'bobot', 'kpd_role')->orderBy('id', 'DESC')->get());
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_katxrole' => 'required|numeric',
            'namkuesxrole' => 'required|min:1|max:255|unique:kuesioner_xrole,namkuesxrole',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner XRole maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner XRole minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kuesioner XRole sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_xrole = new KuesionerXRole;
            $kuesioner_xrole->id_katxrole = $request->id_katxrole;
            $kuesioner_xrole->namkuesxrole = $request->namkuesxrole;
            $kuesioner_xrole->bobot = $request->bobot;
            $kuesioner_xrole->kpd_role = $request->kpd_role;
            $kuesioner_xrole->status_kuesioner = $request->status_kuesioner;
            $kuesioner_xrole->save();
            return $this->showData($kuesioner_xrole);
        }
    }

    public function showDetail($id)
    {
        $kuesioner_xrole = KuesionerXRole::with('kategori')->find($id);
        return $this->showData($kuesioner_xrole);
    }

    public function update(Request $request, $id)
    {
        $kuesioner_xrole = KuesionerXRole::find($id);
        $validator = Validator::make($request->all(), [
            'id_katxrole' => 'required|numeric',
            'namkuesxrole' => 'required|min:1|max:255',
            'bobot' => 'required|numeric',
            'kpd_role' => 'required|numeric',
            'status_kuesioner' => 'required|numeric'
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kuesioner XRole maksimal 255 karakter.',
            'min' => 'Inputan Nama Kuesioner XRole minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kuesioner_xrole->id_katxrole = $request->id_katxrole;
            $kuesioner_xrole->namkuesxrole = $request->namkuesxrole;
            $kuesioner_xrole->bobot = $request->bobot;
            $kuesioner_xrole->kpd_role = $request->kpd_role;
            $kuesioner_xrole->status_kuesioner = $request->status_kuesioner;
            $kuesioner_xrole->save();
        }

        return $this->showData($kuesioner_xrole);
    }

    public function delete($id)
    {
        $data = KuesionerXRole::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KuesionerXRole::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
