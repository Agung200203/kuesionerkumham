<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiTools;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JabatanExport;

use App\Models\Jabatan;

class JabatanController extends Controller //ApiResponser, kalau mau pakai
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api'])->except(['exportJabatan']);
    }

    public function index()
    {
        $jabatan = Jabatan::all();
        if (request()->has('query')) {
            $q = request()->get('query');
            $jabatan = Jabatan::where('nama', 'LIKE', '%' . $q . '%')
                ->orderBy('id', 'DESC')
                ->get();
        }
        return $this->showAll($jabatan);
        // dd($jabatan);
        // return response()->json($this->dataAuthUser(Jabatan::select('id', 'kode_jabatan', 'nama', 'status_jabatan')->orderBy('id', 'DESC')->get()));
    }

    public function listJabatan()
    {   
        return response()->json(Jabatan::select('id', 'kode_jabatan', 'nama')->orderBy('id', 'DESC')->get());
    }

    public function showDetail($id)
    {
        $jabatan = Jabatan::find($id);
        return $this->showData($jabatan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_jabatan' => 'sometimes|string|min:1|max:255|unique:jabatan,kode_jabatan',
            'nama' => 'required|min:1|max:255',
            'status_jabatan' => 'required|numeric|gte:0|lt:2',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'min' => 'Inputan data minimal 1 karakter / tidak boleh kosong.',
            'max' => 'Inputan data maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $jabatan = new Jabatan;
            $jabatan->nama = $request->nama;
            $jabatan->status_jabatan = $request->status_jabatan;
            if ($request->has('kode_jabatan')) {
                $jabatan->kode_jabatan = $request->kode_jabatan;
            }
            $jabatan->save();
            return $this->showData($jabatan);
        }
    }

    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        $validator = Validator::make($request->all(), [
            'kode_jabatan' => 'sometimes|string|min:1|max:255',
            'nama' => 'required|string|min:1|max:255',
            'status_jabatan' => 'required|numeric|gte:0|lt:2',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'min' => 'Inputan data minimal 1 karakter / tidak boleh kosong.',
            'max' => 'Inputan data maksimal 255 karakter.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $jabatan->nama = $request->nama;
            $jabatan->status_jabatan = $request->status_jabatan;
            if ($request->has('kode_jabatan')) {
                $jabatan->kode_jabatan = $request->kode_jabatan;
            } else {
                $jabatan->kode_jabatan = null;
            }
            $jabatan->save();
        }

        return $this->showData($jabatan);
    }

    public function delete($id)
    {
        $data = Jabatan::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            Jabatan::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }

    // public function exportJabatan(){
    //     Excel::download(new JabatanExport, 'jabatan.xslx', XLSX);
    // }
}
