<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\UPT;
use App\Models\Wilayah;

class UPTController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(){
        $upt = new UPT;
        if (request()->has('query')) {
            $q = request()->get('query');
            $upt = $upt->where('nama', 'LIKE', '%' . $q . '%');
        }

        if (request()->has('id_wil')) {
            $q = request()->get('id_wil');
            $upt = $upt->where('id_wil', '=', $q);
        }

        $upt = $upt->get()->pluck('id')->toArray();
        $data = UPT::whereIn('id', $upt)->with('wilayah')->orderBy('id', 'DESC')->get();
        return $this->showAll($data);
    }

    public function listUpt(){
        return response()->json(UPT::select('id', 'nama')->orderBy('id', 'DESC')->get());
    }

    public function showDetail($id){
        $upt = UPT::with('wilayah')->find($id);
        return $this->showData($upt);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'kode' => 'sometimes|min:1|max:255|unique:upt,kode',
            'nama' => 'required|min:1|max:255',
            'alamat' => 'required',
            'kapupt' => 'required|min:1|max:255',
            'email' => 'email|required',
            'no_telp' => 'required|regex:/[0-9]{9}/|max:15',
            'id_wil' => 'required|numeric',
            'status_upt' => 'in:0,1'
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $upt = new UPT;
            $upt->kode = $request->kode;
            $upt->nama = $request->nama;
            $upt->alamat = $request->alamat;
            $upt->kapupt = $request->kapupt;
            $upt->email = $request->email;
            $upt->no_telp = $request->no_telp;
            $upt->id_wil = $request->id_wil;
            if ($request->has('status_upt')) {
                $upt->status_upt = $request->status_upt;
            }
            $upt->save();
            return $this->showData($upt);
        }
    }

    public function update(Request $request, $id){
        $upt = UPT::find($id);
        $validator = Validator::make($request->all(), [
            'kode' => 'sometimes|min:1|max:255',
            'nama' => 'required|min:1|max:255',
            'alamat' => 'required|unique:wilayah,alamat',
            'kapupt' => 'required|min:1|max:255',
            'email' => 'email|required',
            'no_telp' => 'required|regex:/[0-9]{9}/|max:15',
            'id_wil' => 'required|numeric',
            'status_upt' => 'in:0,1'
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $upt->kode = $request->kode;
            $upt->nama = $request->nama;
            $upt->alamat = $request->alamat;
            $upt->kapupt = $request->kapupt;
            $upt->email = $request->email;
            $upt->no_telp = $request->no_telp;
            $upt->id_wil = $request->id_wil;
            if ($request->has('status_upt')) {
                $upt->status_upt = $request->status_upt;
            }
            $upt->save();
        }

        return $this->showData($upt);
    }

    public function delete($id){
        $data = UPT::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            UPT::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
