<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriVOCs;

class KategoriVOCController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(){
        $kategori_vocs = new KategoriVOCs();
        if (request()->has('query')) {
            $q = request()->get('query');
            $kategori_vocs = $kategori_vocs->where('namkat_vocs', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('status_kategori')) {
            $q = request()->get('status_kategori');
            $kategori_vocs = $kategori_vocs->where('status_kategori','=',$q);
        }
        $kategori_vocs = $kategori_vocs->get()->pluck('id')->toArray();
        $data = KategoriVOCs::whereIn('id', $kategori_vocs)
            ->with('kuesioner')
            ->orderBy('id', 'DESC')
            ->get();
            // ->with('kuesioner')
            // ->orderBy('id', 'DESC')
            // ->get();
        return $this->showAll($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'namkat_vocs' => 'required|min:1|max:255|unique:kategori_vocs,namkat_vocs',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori VOCs maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori VOCs minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kategori VOCs sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_vocs = new KategoriVOCs();
            $kategori_vocs->namkat_vocs = $request->namkat_vocs;
            $kategori_vocs->status_kategori = $request->status_kategori;
            $kategori_vocs->save();
            return $this->showData($kategori_vocs);
        }
    }

    public function showDetail($id){
        $kategori_vocs = KategoriVOCs::with('kuesioner')->find($id);
        return $this->showData($kategori_vocs);
    }

    public function update(Request $request, $id){
        $kategori_vocs = KategoriVOCs::find($id);
        $validator = Validator::make($request->all(), [
            'namkat_vocs' => 'required|min:1|max:255',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori VOCs maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori VOCs minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_vocs->namkat_vocs = $request->namkat_vocs;
            $kategori_vocs->status_kategori = $request->status_kategori;
            $kategori_vocs->save();
        }

        return $this->showData($kategori_vocs);
    }

    public function delete($id){
        $data = KategoriVOCs::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KategoriVOCs::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
