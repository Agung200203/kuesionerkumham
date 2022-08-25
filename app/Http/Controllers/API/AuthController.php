<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Traits\ApiTools;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\JabatanUPT;

class AuthController extends Controller
{
    use ApiTools;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registerUser', 'registerPegawai', 'mspam', 'cekLogin']]);
        // $this->middleware(['auth:api', 'verified'], ['except' => 'login', 'registerUser', 'registerPegawai','mspam']);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|between:5,20',
            'nama' => 'required|between:2,100',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|confirmed|string|min:6', //harus membuat password_confimation
            'id_pegawai' => 'required|numeric|unique:users,id_pegawai',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'min' => 'Inputan setting Password minimal 6 karakter.',
            'max' => 'Inputan setting Email maksimal 50 karakter.',
            'email' => 'Email harus terkandung karakter "@" dan domain.',
            'confirmed' => 'Password belum di konfimasi, harap isi Konfirmasi Password.',
            'unique' => 'Data Pegawai sudah memiliki user.',
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            $exists = DB::table('pegawai')->where('nama', '=', $request->nama)->where('nip', '=', $request->nip)->get();
            if (count($exists) != null) {
                $user = User::create(
                    [
                        'id_pegawai' => $request->id_pegawai,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]
                );
                $pass = DB::table('users')->where('email', '=', $request->email)->get(["password"]);
                $passCheck = Hash::check($request->password, $pass[0]->password);
                if ($passCheck) {
                    return response()->json([
                        'message' => 'Successfully registered',
                        'user' => DB::table('users')->where('email', '=', $request->email)->get(),
                    ], 201);
                } else {
                    return response()->json(["messages" => "Data error, check the database for maintenance ^_^"]);
                }
            } else {
                return response()->json(["messages" => "Tidak ada data" . $request->name . "dengan NIP (" . $request->nip . ") dalam database untuk membuat akun user"]);
            }
        }
    }

    public function registerPegawai(Request $request)
    {
        // return response()->json($request->all());
        $cekAtasan = true;
        $atasan_id = null;
        $validator = Validator::make($request->all(), [
            'nip' => 'required|max:20|unique:pegawai,nip',
            'nama' => 'required|between:2,100',
            'gender' => 'required|in:L,P',
            'id_jabatan' => 'required|numeric',
            'id_upt' => 'required|numeric',
            'id_wilayah' => 'required|numeric',
            'id_atasan' => 'numeric',
            'no_telp' => 'required|regex:/[0-9]{9}/|between:3,15',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'tgl_masuk' => 'sometimes',
            'pendidikan' => 'required|in:SMA,SMK,MA,D1,D2,D3,D4,S1,S2,S3',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'max' => 'Inputan NIP maksimal 50 karakter.',
            'unique' => 'Data NIP sudah terdaftar.',
            'regex' => 'Inputan Nomor Telepon haruslah angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([$validator->errors()]);
        } else {
            // Deklarasi Jabatan UPT
            $id_jab_upt = JabatanUPT::where('jab_id','=',$request->id_jabatan)->where('upt_id','=',$request->id_upt)->where('wil_id','=',$request->id_wilayah)->get();
            if(sizeof($id_jab_upt) == 0 ){
                return response()->json(['message'=> "struktur jabatan pada upt ".$request->id_upt." pada wilayah ". $request->id_wilayah ." tidak ditemukann !!!"]);
            }else{
                $id_jab_upt = $id_jab_upt[0]->id;
            };
            

            // Cek Atasan benar
            if($request->has('id_atasan')){
                $data_atasan = Pegawai::find($request->id_atasan);
                if(empty($data_atasan)){
                    $cekAtasan = false;
                } else {
                    $jab_atas_id = $data_atasan->id_jabatan;
                    $upt_atas_id = $data_atasan->id_upt;
                    $wil_atas_id = $data_atasan->id_wilayah;
                    $jab_upt_atasan = JabatanUPT::where('jab_atas_id','=',$jab_atas_id)->where('upt_atas_id','=',$upt_atas_id)->where('wil_atas_id','=',$wil_atas_id)->where('jab_id','=',$request->id_jabatan)->where('upt_id','=',$request->id_upt)->where('wil_id','=',$request->id_wilayah)->get();
                    if(!count($jab_upt_atasan)){
                        $cekAtasan = false;
                    } else {
                        $cekAtasan = true;
                        $atasan_id = $request->id_atasan;
                    }
                }
            }
            // return response()->json($atasan_id, 200);
            // KONDISI FOTO
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
                $pegawai = Pegawai::create([
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'tgl_masuk' => $request->tgl_masuk,
                    'pendidikan' => $request->pendidikan,
                    'gender' => $request->gender,
                    'id_jabatan' => $request->id_jabatan,
                    'id_upt' => $request->id_upt,
                    'id_wilayah' => $request->id_wilayah,
                    'id_jab_upt' => $id_jab_upt,
                    'id_atasan' => $atasan_id,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'foto' => "Storage/Foto_Pegawai/" . $nama_file
                ]);
            } else {
                $pegawai = Pegawai::create([
                    'nip' => $request->nip,
                    'nama' => $request->nama,
                    'tgl_lahir' => $request->tgl_lahir,
                    'tgl_masuk' => $request->tgl_masuk,
                    'pendidikan' => $request->pendidikan,
                    'gender' => $request->gender,
                    'id_jabatan' => $request->id_jabatan,
                    'id_jab_upt' => $id_jab_upt,
                    'id_upt' => $request->id_upt,
                    'id_wilayah' => $request->id_wilayah,
                    'id_atasan' => $atasan_id,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat
                ]);
            }
            return response()->json([
                'message' => 'Successfully registered',
                'pegawai' => $pegawai
            ], 201);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'Email harus terkandung karakter "@" dan domain',
            'string' => 'Inputan haruslah sebuah string',
            'min' => 'Minimal inputan adalah 6 karakter'
        ]);

        $password = DB::table('users')->where('email', '=', $request->email)->get('password');

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Email atau Password salah'], 401);
        }

        if (Hash::check($request->password, $password[0]->password)) {
            User::where('email', '=', $request->email)->update([
                'remember_token' => $token,
            ]);
            $idUser = User::where('email', '=', $request->email)->get('id');
            return response()->json(['user' => $this->createNewToken($token), 'pegawai' => User::find($idUser[0]->id)->pegawai]);
            // return redirect('/home')->with(['login'=>$this->createNewToken($token)]);
        }
    }

    /**
     * Check the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cekLogin(){
        $valid = auth()->check();
        if ($valid == false){
            return $this->errorResponse("Unauthenticated", 401);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $idUser = auth()->user()->id;
        $usr = User::where('users.id', '=', $idUser)->join('pegawai', 'users.id_pegawai', '=', 'pegawai.id')->select('users.email', 'users.lvl_user', 'users.password', 'users.id_pegawai', 'pegawai.nip', 'pegawai.nama', 'pegawai.tgl_lahir', 'pegawai.tgl_masuk as masuk_kerja','pegawai.pendidikan', 'pegawai.gender', 'pegawai.id_jabatan', 'pegawai.id_upt', 'pegawai.id_wilayah', 'pegawai.no_telp', 'pegawai.alamat', 'pegawai.foto as foto', 'pegawai.status_pegawai as statusPegawai', 'users.status as statusUser')->get();
        // return response()->json();
        if($usr[0]->foto == null){
            $usr[0]->foto = 'https://dev.gemasolusindo.co.id/karpeg_moker_kab/public/no-image-available.png';
        }
        return response()->json($usr);
    }

    // public function updateProfile()

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 720,
            'expires_in' => auth()->factory()->getTTL() * 720,
            'user' => auth()->user()
        ]);
    }

    public function mspam(Request $request)
    {
        dd($request->all());
    }
    // 'data' => ['1','2','3','4','5']
}
