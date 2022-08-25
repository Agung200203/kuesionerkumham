<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\ApiResponser;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiTools;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Models\Wilayah;

class WilayahController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $Wilayah = Wilayah::all();
        if (request()->has('query')) {
            $q = request()->get('query');
            $Wilayah = Wilayah::where('nama', 'LIKE', '%' . $q . '%')->orWhere('alamat', '=', '%' . $q . '%')->orderBy('id', 'DESC')->get();
        }
        return $this->showAll($Wilayah);
    }
    public function listWilayah()
    {
        return response()->json(Wilayah::select('id', 'nama', 'alamat')->orderBy('id', 'DESC')->get());
    }

    public function autocomplete()
    {
        // autocomplete kakanwil
        return response()->json(Pegawai::select('id', 'nip', 'nama')->where('status_pegawai', '=', 1)->orderBy('id', 'DESC')->get());
    }

    public function showDetail($id)
    {
        $Wilayah = Wilayah::find($id);
        return $this->showData($Wilayah);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:1|max:255',
            'alamat' => 'required|unique:wilayah,alamat',
            'kakanwil' => 'required|min:1|max:255',
            'email' => 'email|required',
            'no_telp' => 'required|regex:/[0-9]{9}/|max:15',
            'status_wilayah' => 'in:0,1'
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $Wilayah = new Wilayah;
            $Wilayah->nama = $request->nama;
            $Wilayah->alamat = $request->alamat;
            $Wilayah->kakanwil = $request->kakanwil;
            $Wilayah->email = $request->email;
            $Wilayah->no_telp = $request->no_telp;
            if ($request->has('status_wilayah')){
            }
            $Wilayah->save();
            return $this->showData($Wilayah);
        }
    }

    public function update(Request $request, $id)
    {
        $Wilayah = Wilayah::find($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:1|max:255',
            'alamat' => 'required',
            'kakanwil' => 'required|min:1|max:255',
            'email' => 'email|required',
            'no_telp' => 'required|regex:/[0-9]{9}/|max:15',
            'status_wilayah' => 'in:0,1'
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $Wilayah->nama = $request->nama;
            $Wilayah->alamat = $request->alamat;
            $Wilayah->kakanwil = $request->kakanwil;
            $Wilayah->email = $request->email;
            $Wilayah->no_telp = $request->no_telp;
            if ($request->has('status_wilayah')) {
                $Wilayah->status_wilayah = $request->status_wilayah;
            }
            $Wilayah->save();
        }

        return $this->showData($Wilayah);
    }

    public function delete($id)
    {
        $data = Wilayah::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            Wilayah::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
