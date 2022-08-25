<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriXRole;


class KategoriXRoleController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(){
        $kategori_xrole = new KategoriXRole();
        if (request()->has('query')) {
            $q = request()->get('query');
            $kategori_xrole = $kategori_xrole->where('namkat_xrole', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('status_kategori')) {
            $q = request()->get('status_kategori');
            $kategori_xrole = $kategori_xrole->where('status_kategori','=',$q);
        }
        $kategori_xrole = $kategori_xrole->get()->pluck('id')->toArray();
        $data = KategoriXRole::whereIn('id', $kategori_xrole)
            ->with('kuesioner')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'namkat_xrole' => 'required|min:1|max:255|unique:kategori_xrole,namkat_xrole',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori XRole maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori XRole minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kategori XRole sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_xrole = new KategoriXRole();
            $kategori_xrole->namkat_xrole = $request->namkat_xrole;
            $kategori_xrole->status_kategori = $request->status_kategori;
            $kategori_xrole->save();
            return $this->showData($kategori_xrole);
        }
    }

    public function showDetail($id){
        $kategori_xrole = KategoriXRole::with('kuesioner')->find($id);
        return $this->showData($kategori_xrole);
    }

    public function update(Request $request, $id){
        $kategori_xrole = KategoriXRole::find($id);
        $validator = Validator::make($request->all(), [
            'namkat_xrole' => 'required|min:1|max:255',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori XRole maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori XRole minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_xrole->namkat_xrole = $request->namkat_xrole;
            $kategori_xrole->status_kategori = $request->status_kategori;
            $kategori_xrole->save();
        }

        return $this->showData($kategori_xrole);
    }

    public function delete($id){
        $data = KategoriXRole::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KategoriXRole::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
