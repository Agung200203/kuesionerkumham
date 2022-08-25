<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JabatanUPT;
use Illuminate\Http\Request;
use App\Traits\ApiTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use SebastianBergmann\Type\ObjectType;
use stdClass;

use App\Models\MasterPenilaianVOC;
use App\Models\PenilaianVOC;
use App\Models\Pegawai;

class PenilaianVOCController extends Controller
{
    use ApiTools;

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Index-nya Master Penilaian VOCs
     */
    public function master_index()
    {
        $masterVOC = new MasterPenilaianVOC;

        // if (request()->has('query')) {
        //     $q = request()->get('query');
        //     $masterVOC = $masterVOC->where('nama', 'LIKE', '%' . $q . '%');
        // }

        if (request()->has('id_user_penilai')) { //PENILAI
            $q = request()->get('id_user_penilai');
            $masterVOC = $masterVOC->where('id_user_penilai', 'LIKE', '%' . $q . '%');
        }

        if (request()->has('id_user_pegawai')) { //DINILAI
            $q = request()->get('id_user_pegawai');
            $masterVOC = $masterVOC->where('id_user_pegawai', 'LIKE', '%' . $q . '%');
        }

        if (request()->has('id_periode')) { //PERIODE
            $q = request()->get('id_periode');
            $masterVOC = $masterVOC->where('id_periode', 'LIKE', '%' . $q . '%');
        }

        if (request()->has('status')) { //STATUS
            $q = request()->get('status');
            $masterVOC = $masterVOC->where('status', 'LIKE', '%' . $q . '%');
        }

        $masterVOC = $masterVOC->get()->pluck('id')->toArray();
        $data = MasterPenilaianVOC::whereIn('id', $masterVOC)
            ->with('penilai')->with('dinilai')->with('periode')
            ->orderBy('id', 'DESC')
            ->get();
        return $this->showAll($data);
    }

    /**
     * Index-nya Penilaian VOCs berdasarkan ID Master Penilaian VOCs
     */
    public function index($idMasterPenilaian)
    {
        $penilaianVOCs = $this->indexPenilaianVOCs($idMasterPenilaian);
        // for ($i = 0; $i < count($penilaianVOCs); $i++){
        //     $arr[$i] = $penilaianVOCs[$i]->id;
        // }
        return response()->json($penilaianVOCs);
    }

    public function indexPenilaianVOCs($id)
    {
        $penilaianVOCs = PenilaianVOC::where('id_master', '=', $id)->join('kuesioner_vocs', 'penilaianvocs.kuesioner_id', '=', 'kuesioner_vocs.id')->select('penilaianvocs.id', 'kuesioner_id', 'kuesioner_vocs.namkuesvocs as kuesioner', 'penilaianvocs.id_master', 'penilaianvocs.jawaban', 'penilaianvocs.rating', 'kuesioner_vocs.bobot', 'penilaianvocs.nilaiTerbobot', 'kuesioner_vocs.kpd_role', 'kuesioner_vocs.status_kuesioner as status')->where('kuesioner_vocs.status_kuesioner', '=', 1)->get();
        return $penilaianVOCs;
    }

    /**
     * Langsung menemukan data penilai dari LocalStorage.idPegawai
     */
    public function penilai($idPegawai)
    {
        $resp = Pegawai::select('id', 'nip', 'nama')->where('status_pegawai', '=', 1)->where('id', '=', $idPegawai)->first();
        if (count($resp) > 0) {
            return response()->json($resp);
        } else {
            return $this->showMessage("Tidak ditemukan", 503);
        }
    }

    /**
     * Untuk selectpicker pegawai yang dinilai
     */
    public function dinilai()
    {
        return response()->json(Pegawai::select('id', 'nip', 'nama')->where('status_pegawai', '=', 1)->orderBy('id', 'DESC')->get());
    }

    /**
     * Fungsi untuk memiliih pegawai dan sekaligus membuat Master Penilaian sebagai Master Table
     *
     * @return this() indexPenilaianVOCs
     */
    public function getDataPegawai($idDinilai)
    {
        $data = new stdClass;
        $data->penilai = Pegawai::with(['pegawai', 'wilayah', 'upt', 'jabatan', 'atasan'])->find(auth()->user()->id_pegawai);
        $data->dinilai = Pegawai::with(['pegawai', 'wilayah', 'upt', 'jabatan', 'atasan'])->find($idDinilai);
        return $data;
    }

    /**
     * Fungsi untuk memiliih pegawai dan sekaligus membuat Master Penilaian sebagai Master Table
     */
    public function store(Request $request)
    {
        $data = new stdClass;
        Validator::make($request->all(), [
            'periode' => 'required',
            'penilai' => 'required',
            'dinilai' => 'required',
            // 'status' => 'required | in:0,1,2,3,4',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',
            'in' => 'Data hanya dapat diisi dengan Atasan, Sejawat, Bawahan, Dirinya'
        ]);
        // DEKLARASI REQUEST
        $periodePenilaian = $request->periode;
        $pegawaiPenilai = $request->penilai;
        $pegawaiDinilai = $request->dinilai;
        // $statusRole = $request->status;
        $statusRole = $this->getRoleStatus($pegawaiPenilai, $pegawaiDinilai); //1=atas,2=sejawat,3=bawahan,4=dirinya, 0=off & hidden
        // return response()->json($statusRole);

        // get data penilai dan dinilai
        $data->pegawai = $this->getDataPegawai($pegawaiDinilai);

        $cekAdaPenilaian = MasterPenilaianVOC::where('id_user_penilai', '=', $pegawaiPenilai)->where('id_user_pegawai', '=', $pegawaiDinilai)->where('id_periode', '=', $periodePenilaian)->where('status', '=', $statusRole)->get();
        // KONDISI CREATE GENERATE BILA BELUM ADA, DAN TUNJUKKAN SAJA JIKA SUDAH ADA
        if (count($cekAdaPenilaian) > 0) {
            $masterPenilaian = $cekAdaPenilaian;
            $data->kuesioner = $this->indexPenilaianVOCs($masterPenilaian[0]->id);
            return response()->json(['pegawai' => $data->pegawai, 'kuesioner' => $data->kuesioner]);
        } else {
            // STORE MASTER PENILAIAN
            $masterPenilaianVOC = new MasterPenilaianVOC;
            $masterPenilaianVOC->id_user_penilai = $pegawaiPenilai;
            $masterPenilaianVOC->id_user_pegawai = $pegawaiDinilai;
            $masterPenilaianVOC->id_periode = $periodePenilaian;
            $masterPenilaianVOC->status = $statusRole;
            // MENYIMPAN DATA MASTER PENILAIAN BARU
            $masterPenilaianVOC->save();

            // GENERATE PENILAIAN VOCS DARI MASTER-TABLE
            $idMasterPenilaian = $masterPenilaianVOC->id;
            $masterPenilaian = DB::select('call penilaian_generate_voc(?,?)', [$idMasterPenilaian, $masterPenilaianVOC->status]);

            $data->kuesioner = $this->indexPenilaianVOCs($idMasterPenilaian);
            return response()->json(['pegawai' => $data->pegawai, 'kuesioner' => $data->kuesioner]);
            // return $this->showData($masterPenilaian); //Dapat dip    ergunakan untuk show penilaian, ketimbang pakai index()

        }
    }

    public function getIdMaster(Request $request)
    {
        Validator::make($request->all(), [
            'periode' => 'required',
            'penilai' => 'required',
            'dinilai' => 'required',
            // 'status' => 'required | in:0,1,2,3,4',
        ], [
            'required' => 'Data yang bertanda bintang "*" wajib diisi.',    
            'in' => 'Data hanya dapat diisi dengan Atasan, Sejawat, Bawahan, Dirinya'
        ]);
        // DEKLARASI REQUEST
        $periodePenilaian = $request->periode;
        $pegawaiPenilai = $request->penilai;
        $pegawaiDinilai = $request->dinilai;
        // $statusRole = $request->status;
        $statusRole = $this->getRoleStatus($pegawaiPenilai, $pegawaiDinilai); //1=atas,2=sejawat,3=bawahan,4=dirinya, 0=off & hidden


        $cekAdaPenilaian = MasterPenilaianVOC::where('id_user_penilai', '=', $pegawaiPenilai)->where('id_user_pegawai', '=', $pegawaiDinilai)->where('id_periode', '=', $periodePenilaian)->where('status', '=', $statusRole)->get();

        return response()->json($cekAdaPenilaian);
    }


    /**
     * Fungsi untuk meng-update Penilaian
     */
    public function update(Request $request, $idMasterPenilaian)
    {
        // DEKLARASI VARIABEL DB & REQUEST
        // $penilaianVOCs = $this->indexPenilaianVOCs($idMasterPenilaian);
        $semua = $request->all();
        return response()->json($semua);

        if (count($semua) > 0) {
            for ($i = 0; $i < count($semua['id_penilaian']); $i++) {
                // $dataPenilaian = PenilaianVOC::find($penilaianVOCs[$i]->id_penilaian);
                $dataPenilaian = PenilaianVOC::find( $request->input('id_penilaian')[$i]);
                // JIKA ID ADALAH SESUAI DENGAN DI DATABASE
                if ($dataPenilaian->id == $request->input('id_penilaian')[$i]) {
                    // DEKLARASI PER RECORD
                    $nilaiTerbobot = $dataPenilaian->bobot * $request->input('rating')[$i];
                    $update  = array(
                        $request->input('jawaban')[$i],
                        $request->input('rating')[$i],
                        $nilaiTerbobot,
                        $request->input('id_penilaian')[$i],
                    );

                    // UPDATING
                    $updatePenilaian = DB::select('CALL VOCs_update_penilaian(?,?,?,?)', $update);
                } else {
                    return $this->showMessage("Terdapat error di [id ke" . $dataPenilaian[$i]->id . "]", 503);
                }
            }
            // $cobavar = PenilaianVOC::where('penilaianvocs.id_master','=',$masterPenilaian[0]->id)->join('kuesioner_vocs', 'penilaianvocs.kuesioner_id','=','kuesioner_vocs.id')->select('penilaianvocs.kuesioner_id','penilaianvocs.id_master','penilaianvocs.jawaban','penilaianvocs.rating','penilaianvocs.nilaiTerbobot','kuesioner_vocs.id_katvocs as kategori','kuesioner_vocs.namkuesvocs','kuesioner_vocs.bobot')->where('kuesioner_vocs.id_katvocs','=',8)->get();
            // 
        } else {
            return $this->showMessage("Tidak ada Request yang masuk", 503);
        }
    }

    // public function
}
