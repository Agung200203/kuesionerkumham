<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\KategoriSpeed;

class KategoriSpeedController extends Controller
{
    use ApiTools;
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(){
        $kategori_speedec = new KategoriSpeed();
        if (request()->has('query')) {
            $q = request()->get('query');
            $kategori_speedec = $kategori_speedec->where('namkat_speed', 'LIKE', '%' . $q . '%');
        }
        if (request()->has('status_kategori')) {
            $q = request()->get('status_kategori');
            $kategori_speedec = $kategori_speedec->where('status_kategori','=',$q);
        }
        $kategori_speedec = $kategori_speedec->get()->pluck('id')->toArray();
        $data = KategoriSpeed::whereIn('id', $kategori_speedec)
            ->with('kuesioner')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'namkat_speed' => 'required|min:1|max:255|unique:kategori_speedec,namkat_speed',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori Speedec maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori Speedec minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
            'unique' => 'Data Nama Kategori Speedec sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_speedec = new KategoriSpeed();
            $kategori_speedec->namkat_speed = $request->namkat_speed;
            $kategori_speedec->status_kategori = $request->status_kategori;
            $kategori_speedec->save();
            return $this->showData($kategori_speedec);
        }
    }

    public function showDetail($id){
        $kategori_speedec = KategoriSpeed::with('kuesioner')->find($id);
        return $this->showData($kategori_speedec);
    }

    public function update(Request $request, $id){
        $kategori_speedec = KategoriSpeed::find($id);
        $validator = Validator::make($request->all(), [
            'namkat_speed' => 'required|min:1|max:255',
            'status_kategori' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan Nama Kategori Speedec maksimal 255 karakter.',
            'min' => 'Inputan Nama Kategori Speedec minimal 1 karakter.',
            'numeric' => 'Inputan harus berupa numerik.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $kategori_speedec->namkat_speed = $request->namkat_speed;
            $kategori_speedec->status_kategori = $request->status_kategori;
            $kategori_speedec->save();
        }

        return $this->showData($kategori_speedec);
    }

    public function delete($id){
        $data = KategoriSpeed::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            KategoriSpeed::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
