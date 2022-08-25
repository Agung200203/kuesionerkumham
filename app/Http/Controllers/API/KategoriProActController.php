<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriProAct;

class KategoriProActController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $kategori_proact = new KategoriProAct;
        if (request()->has('query')) {
            $q = request()->get('query');
            $kategori_proact = $kategori_proact->where('namkat_proact', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('status_kategori')) {
            $q = request()->get('status_kategori');
            $kategori_proact = $kategori_proact->where('status_kategori', '=', $q);
        }
        $kategori_proact = $kategori_proact->get()->pluck('id')->toArray();
        $data = KategoriProAct::whereIn('id', $kategori_proact)
            ->with('kuesioner')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namkat_proact' => 'required|min:1|max:255|unique:kategori_proact,namkat_proact',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori ProAct maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori ProAct minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kategori ProAct sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_proact = new KategoriProAct;
            $kategori_proact->namkat_proact = $request->namkat_proact;
            $kategori_proact->status_kategori = $request->status_kategori;
            $kategori_proact->save();
            return $this->showData($kategori_proact);
        }
    }

    public function showDetail($id)
    {
        $kategori_proact = KategoriProAct::with('kuesioner')->find($id);
        return $this->showData($kategori_proact);
    }

    public function update(Request $request, $id)
    {
        $kategori_proact = KategoriProAct::find($id);
        $validator = Validator::make($request->all(), [
            'namkat_proact' => 'required|min:1|max:255',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori ProAct maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori ProAct minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_proact->namkat_proact = $request->namkat_proact;
            $kategori_proact->status_kategori = $request->status_kategori;
            $kategori_proact->save();
        }

        return $this->showData($kategori_proact);
    }

    public function delete($id)
    {
        $data = KategoriProAct::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KategoriProAct::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
