<?php

namespace App\Http\Controllers\API;

// USE CONTROLLERS
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\ApiResponser;
// USE ILLMINATE PACKAGES
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use App\Traits\ApiTools;
use ZipArchive;

// USE MODELS
use App\Models\User;
// USE EXPORTS
use App\Exports\JabatanExport;
use App\Exports\PegawaiExport;
use App\Exports\UPTExport;
use App\Exports\UserExport;
use App\Exports\WilayahExport;
use App\Exports\PeriodePenilaianExport;
use App\Exports\KatProActExport;
use App\Exports\KatSpeedExport;
use App\Exports\KatVOCsExport;
use App\Exports\KatXRoleExport;
use App\Exports\KuesVOCsExport;
// USE IMPORTS

class ExImController extends Controller
{
    use ApiTools;

    // public function __construct()
    // {
    //     $this->middleware(['auth:api'])->except(['export','zipFile','download']);
    // }
    // public function import(Request $request)
    // {
    //     $this->validate($request, [
    //         'tipe' => 'required'
    //     ]);

    //     $extensions = ["xls","xlsx","csv"];
    //     for ($i = 0; $i < count($request->file('file')); $i++) {
    //         $search = array_search($request->file('file')[$i]->getClientOriginalExtension(), $extensions);
    //         if (gettype($search) == 'boolean') {
    //             return $this->errorResponse('File Tidak Support', 400);
    //             break;
    //         }
    //     }

    //     $files = collect($request->file('file'));
    //     $filenames = [];
    //     $files = $files->sortBy(function($file) {
    //         return $file->getClientOriginalName();
    //     });
    //     foreach($files as $f) {
    //         array_push($filenames, $f);
    //     }

    //     $tipes = $request->tipe;
    //     sort($tipes);

    //     for($i = 0; $i < count($tipes); $i++) {
    //         $tipe = $tipes[$i];
    //         $file = $filenames[$i];
    //         if ($tipe == '1_kategoriPermasalahan') {
    //             Excel::import(new KategoriPermasalahanImport(), $file);
    //         }

    //         if ($tipe == '2_jenisProduk') {
    //             Excel::import(new JenisProdukImport(), $file);
    //         }
    //     }

    //     return $this->showMessage('BERHASIL IMPORT');
    // }

    public function export(Request $request, $token)
    {
        // dd($request);
        // return response()->json($request->data);
        $this->validate($request, [
            'data' => 'required'
        ], [
            'required' => 'Data Export tidak boleh kosong'
        ]);
        $user = User::where('remember_token', '=', $token)->get();
        // $user = [$token];
        if (count($user) > 0) {
            $zip = $this->zipFile($request->data);
            // $zip = explode('storage/app/', $zip);
            // return Storage::download(end($zip), 'kuesionerkumham.zip');
            return $this->showMessage('Success');
        } else {
            return response()->json(['error' => 'Authorization Token not found', 'code' => 401], 401);
        }
    }

    protected function zipFile($tipes)//($tipes)
    {
        $tipes = $tipes;
        // dd(count($tipes));
        $zip_file = storage_path('app/backup/kuesionerkumham.zip');
        $zip = new ZipArchive;
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if (count($tipes) > 0) {
            foreach($tipes as $tipe) {
                if ($tipe == 'jabatan') {
                    Excel::store(new JabatanExport(), 'backup/Jabatan.xlsx');
                    $filePath = storage_path('app/backup/Jabatan.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Jabatan.xlsx');
                }

                if ($tipe == 'pegawai') {
                    Excel::store(new PegawaiExport(), 'backup/Pegawai.xlsx');
                    $filePath = storage_path('app/backup/Pegawai.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Pegawai.xlsx');
                }

                if ($tipe == 'upt') {
                    Excel::store(new UPTExport(), 'backup/UPT.xlsx');
                    $filePath = storage_path('app/backup/UPT.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/UPT.xlsx');
                }

                if ($tipe == 'users') {
                    Excel::store(new UserExport(), 'backup/Users.xlsx');
                    $filePath = storage_path('app/backup/Users.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Users.xlsx');
                }

                if ($tipe == 'wilayah') {
                    Excel::store(new WilayahExport(), 'backup/Wilayah.xlsx');
                    $filePath = storage_path('app/backup/Wilayah.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Wilayah.xlsx');
                }

                if ($tipe == 'katvocs') {
                    Excel::store(new KatVOCsExport(), 'backup/Kategori_VOCs.xlsx');
                    $filePath = storage_path('app/backup/Kategori_VOCs.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Kategori_VOCs.xlsx');
                }

                if ($tipe == 'katproact') {
                    Excel::store(new KatProActExport(), 'backup/Kategori_ProActs.xlsx');
                    $filePath = storage_path('app/backup/Kategori_ProActs.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Kategori_ProActs.xlsx');
                }

                if ($tipe == 'katxrole') {
                    Excel::store(new KatXRoleExport(), 'backup/Kategori_XRole.xlsx');
                    $filePath = storage_path('app/backup/Kategori_XRole.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Kategori_XRole.xlsx');
                }

                if ($tipe == 'katspeed') {
                    Excel::store(new KatSpeedExport(), 'backup/Kategori_SpeeDec.xlsx');
                    $filePath = storage_path('app/backup/Kategori_SpeeDec.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Kategori_SpeeDec.xlsx');
                }

                if ($tipe == 'kuesvocs') {
                    Excel::store(new KuesVOCsExport(), 'backup/Kuesioner_VOCs.xlsx');
                    $filePath = storage_path('app/backup/Kuesioner_VOCs.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/Kuesioner_VOCs.xlsx');
                }

                if ($tipe == 'periodepenilaian') {
                    Excel::store(new PeriodePenilaianExport(), 'backup/PeriodePenilaian.xlsx');
                    $filePath = storage_path('app/backup/PeriodePenilaian.xlsx');
                    $zip->addFile($filePath, 'KUESIONERKUMHAM/PeriodePenilaian.xlsx');
                }
            }
        }

        $zip->close();
        return $zip_file;
    }

    public function download($token) {
        $user = User::where('remember_token', '=', $token)->get();
        // $user = [$token];
        if (count($user) == 0) {
            return response()->json(['error' => 'Authorization Token not found', 'code' => 401], 401);
        }
        return Storage::download('backup/kuesionerkumham.zip', 'kuesionerkumham.zip');
    }
}
