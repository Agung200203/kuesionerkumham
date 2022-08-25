<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\UPT;
use App\Models\Wilayah;


class PegawaiController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['ac_nama', 'listJabatan', 'listUPT', 'listWil', 'listAtasan']]);
    }

    public function index()
    {
        $pegawai = new Pegawai;
        if (request()->has('query')) {
            $q = request()->get('query');
            $pegawai = $pegawai->where('nama', 'LIKE', '%' . $q . '%');
        }

        if (request()->has('pendidikan')) {
            $q = request()->get('pendidikan');
            $pegawai = $pegawai->where('pendidikan', '=', $q);
        }

        if (request()->has('gender')) {
            $q = request()->get('gender');
            $pegawai = $pegawai->where('gender', '=', $q);
        }

        if (request()->has('id_jabatan')) {
            $q = request()->get('id_jabatan');
            $pegawai = $pegawai->where('id_jabatan', '=', $q);
        }

        if (request()->has('id_upt')) {
            $q = request()->get('id_upt');
            $pegawai = $pegawai->where('id_upt', '=', $q);
        }

        if (request()->has('id_wilayah')) {
            $q = request()->get('id_wilayah');
            $pegawai = $pegawai->where('id_wilayah', '=', $q);
        }

        if (request()->has('id_atasan')) {
            $q = request()->get('id_atasan');
            $pegawai = $pegawai->where('id_atasan', '=', $q);
        }

        // if (request()->has('id_atasan')) {
        //     $q = request()->get('id_atasan');
        //     $pegawai = $pegawai->where('id_atasan', 'LIKE', '%' . $q . '%');
        // }

        $pegawai = $pegawai->get()->pluck('id')->toArray();
        $data = Pegawai::whereIn('id', $pegawai)
            ->with(['pegawai', 'wilayah', 'upt', 'jabatan', 'atasan'])
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function ac_nama()
    {
        return response()->json(Pegawai::select('id', 'nip', 'nama')->where('status_pegawai', '=', 1)->orderBy('id', 'DESC')->get());
    }

    public function listJabatan()
    {
        return response()->json(Jabatan::select('id', 'kode_jabatan', 'nama')->where('status_jabatan', '=', 1)->orderBy('id', 'DESC')->get());
    }

    public function listUPT()
    {
        return response()->json(UPT::select('id', 'kode', 'nama')->where('status_upt', '=', 1)->orderBy('id', 'DESC')->get());
    }

    public function listWil()
    {
        return response()->json(Wilayah::select('id', 'nama')->where('status_wilayah', '=', 1)->orderBy('id', 'DESC')->get());
    }
    public function listAtasan()
    {
        return response()->json(Pegawai::select('id', 'nip', 'nama')->where('status_pegawai', '=', 1)->orderBy('id', 'DESC')->get());
    }

    public function showDetail($id)
    {
        // sementara
        $Pegawai = Pegawai::with(['pegawai', 'wilayah', 'upt', 'jabatan', 'atasan'])->find($id);
        return $this->showData($Pegawai);
    }

    // public function store()
    // {
    //      ada di AuthController -> registerPegawai
    // }

    public function update(Request $request, $id)
    {
        return response()->json($request->all());
        $pegawai = Pegawai::find($id);
        $validator = Validator::make($request->all(), [
            'nip' => 'required|max:20',
            'name' => 'required|between:2,100',
            'gender' => 'required|in:L,P',
            'id_jabatan' => 'required|numeric',
            'id_upt' => 'required|numeric',
            'id_wilayah' => 'required|numeric',
            'id_atasan' => 'numeric',
            'no_telp' => 'required|regex:/[0-9]{9}/|between:3,15',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'pendidikan' => 'required|in:SMA,SMK,MA,D1,D2,D3,D4,S1,S2,S3'
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan NIP maksimal 50 karakter.',
            'unique' => 'Data NIP sudah terdaftar.',
            'regex' => 'Inputan Nomor Telepon haruslah angka.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $pegawai->nip = $request->nip;
            $pegawai->nama = $request->nama;
            $pegawai->tgl_lahir = $request->tgl_lahir;
            $pegawai->pendidikan = $request->pendidikan;
            $pegawai->gender = $request->gender;
            $pegawai->id_jabatan = $request->id_jabatan;
            $pegawai->id_upt = $request->id_upt;
            $pegawai->id_wilayah = $request->id_wilayah;
            $pegawai->id_atasan = $request->id_atasan;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->alamat = $request->alamat;
            if (request()->has('foto')) {
                $filePhoto = $request->file('foto');
                $ident = $request->nip;
                $tujuan_file = 'public/Foto_Pegawai';
                $nama_file = $ident . "_" . time() . "." . $filePhoto->getClientOriginalExtension();
                $filenya = Storage::putFileAs(
                    $tujuan_file,
                    $filePhoto,
                    $nama_file
                );
                $pegawai->foto = "Storage/Foto_Pegawai/" . $nama_file;
            }
            $pegawai->save();
        }
        return $this->showData($pegawai);
    }

    public function delete($id)
    {
        $data = Pegawai::where('id', '=', $id)->get();
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
