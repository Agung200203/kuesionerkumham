<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiTools;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index()
    {
        $dataUser = new User;
        if (request()->has('email')) {
            $q = request()->get('email');
            $dataUser = $dataUser->where('email','=',$q);
        }
        if (request()->has('lvl_user')) {
            $q = request()->get('lvl_user');
            $dataUser = $dataUser->where('lvl_user','=',$q);
        }
        if (request()->has('status')) {
            $q = request()->get('status');
            $dataUser = $dataUser->where('status','=',$q);
        }
        $dataUser = $dataUser->get()->pluck('id')->toArray();
        $data = User::whereIn('id', $dataUser)
            ->with('pegawai')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    public function showDetail($id)
    {
        $dataUser = User::with('pegawai')->find($id);
        return $this->showData($dataUser);
    }

    public function changeRole($id){
        $data = User::find($id);
        $data->lvl_user = 1;

        $data->save();
        return $this->showData($data);
    }

    public function update(Request $request, $id)
    {
        $dataUser = User::find($id);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'id_pegawai' => 'required|numeric',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan data Email maksimal 50 karakter.',
            'email' => 'Email harus terkandung karakter "@" dan domain.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $dataUser->email = $request->email;
            $dataUser->id_pegawai = $request->id_pegawai;

            $dataUser->save();
        }

        return $this->showData($dataUser);
    }

    public function resetPassowrd(Request $request, $id)
    {
        $dataUser = User::find($id);
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|string|min:6', //harus menambahkan password_confirmation
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'min' => 'Inputan Konfirmasi Password minimal 6 karakter.',
            'confirmed' => 'Password belum di konfimasi, harap isi Konfirmasi Password.',
            'string' => 'Password haruslah sebuah string.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $dataUser->password = Hash::make($request->password);
            $dataUser->save();
        }

        return $this->showData($dataUser);
    }

    public function delete($id){
        $data = User::where('id', '=', $id)->get();
        $queryStatus = "Error!";
        try {
            User::where('id', '=', $id)->delete();
            $queryStatus = "Data berhasil dihapus";
        } catch (Exception $e) {
            $queryStatus = "Data gagal dihapus";
        }
        return $this->showMessage(['data' => $data, 'status' => $queryStatus]);
    }
}
