<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JabatanController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\UPTController;
use App\Http\Controllers\API\WilayahController;
use App\Http\Controllers\API\PeriodePenilaianController;
use App\Http\Controllers\API\ExImController;
use App\Http\Controllers\API\UserController;

use App\Http\Controllers\API\KategoriProActController;
use App\Http\Controllers\API\KategoriSpeedController;
use App\Http\Controllers\API\KategoriVOCController;
use App\Http\Controllers\API\KategoriXRoleController;

use App\Http\Controllers\API\KuesProActController;
use App\Http\Controllers\API\KuesSpeedController;
use App\Http\Controllers\API\KuesVOCController;
use App\Http\Controllers\API\KuesXRoleController;

use App\Http\Controllers\API\PenilaianVOCController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('registerUser', [AuthController::class, 'registerUser']);
// Route::post('registerPegawai', [AuthController::class, 'registerPegawai']);
// Route::post('login', [AuthController::class, 'login']);
// // Route::group(['middleware' => ['jwt.verify'],'prefix'=>'auth'], function () {
// Route::group(['middleware' => 'auth:api','prefix'=>'auth'], function () {
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     Route::get('user-profile', [AuthController::class, 'userProfile']);
//     Route::get('jabatan', [JabatanController::class, 'index']);
// });

// Auth::routes(['verify' => true]);
// Route::get('profile', function () {
//     // hanya user yang verified yang bisa mengakses route ini
// })->middleware('verified');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    // Authentication
    Route::post('registerUser', [AuthController::class, 'registerUser']);
    Route::post('registerPegawai', [AuthController::class, 'registerPegawai']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('ceklogin', [AuthController::class, 'cekLogin'])->name('login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    // mspam
    Route::get('dd', [AuthController::class, 'mspam']);

    // User
    Route::get('user', [UserController::class, 'index']);
    Route::get('user/edit/{id}', [UserController::class, 'showDetail']);
    Route::post('user/update/{id}', [UserController::class, 'update']);
    Route::post('user/reset/{id}', [UserController::class, 'resetPassowrd']);
    Route::get('user/delete/{id}', [UserController::class, 'delete']);
    Route::get('user/admin/{id}', [UserController::class, 'changeRole']);

    // Pegawai
    Route::get('pegawai', [PegawaiController::class, 'index']);
    Route::get('pegawai/listpeg', [PegawaiController::class, 'ac_nama']);
    Route::get('pegawai/listjab', [PegawaiController::class, 'listJabatan']);
    Route::get('pegawai/listupt', [PegawaiController::class, 'listUPT']);
    Route::get('pegawai/listwil', [PegawaiController::class, 'listWil']);
    Route::get('pegawai/listatas', [PegawaiController::class, 'listAtasan']);
    // --> pegawai store ada di route('registerPegawai')
    Route::get('pegawai/edit/{id}', [PegawaiController::class, 'showDetail']);
    Route::post('pegawai/update/{id}', [PegawaiController::class, 'update']);
    Route::get('pegawai/delete/{id}', [PegawaiController::class, 'delete']);

    // jabatan
    Route::get('jabatan', [JabatanController::class, 'index']);
    Route::get('jabatan/edit/{id}', [JabatanController::class, 'showDetail']);
    Route::post('jabatan/store', [JabatanController::class, 'store']);
    Route::post('jabatan/update/{id}', [JabatanController::class, 'update']);
    Route::get('jabatan/delete/{id}', [JabatanController::class, 'delete']);
    Route::get('jabatan/list', [JabatanController::class, 'listJabatan']);

    // Route::group(['middleware' => ['jwt.verify']], function() {
    //     Route::get('jabatan', [JabatanController::class, 'index']);
    // });


    // UPT
    Route::get('upt', [UPTController::class, 'index']);
    Route::get('upt/listwil', [UPTController::class, 'listWilayah']);
    Route::get('upt/edit/{id}', [UPTController::class, 'showDetail']);
    Route::post('upt/update/{id}', [UPTController::class, 'update']);
    Route::post('upt/store', [UPTController::class, 'store']);
    Route::get('upt/delete/{id}', [UPTController::class, 'delete']);
    Route::get('upt/list', [UPTController::class, 'listUpt']);


   // wilayah
   Route::get('wilayah', [WilayahController::class, 'index']);
   Route::get('wilayah/listpeg', [WilayahController::class, 'listpegawai']);
   Route::get('wilayah/edit/{id}', [WilayahController::class, 'showDetail']);
   Route::post('wilayah/update/{id}', [WilayahController::class, 'update']);
   Route::post('wilayah/store', [WilayahController::class, 'store']);
   Route::get('wilayah/delete/{id}', [WilayahController::class, 'delete']);
   Route::get('wilayah/list', [WilayahController::class, 'listWilayah']);

    // Kategori ProAct
    Route::get('kategori/proact', [KategoriProActController::class, 'index']);
    Route::post('kategori/proact/store', [KategoriProActController::class, 'store']);
    Route::get('kategori/proact/edit/{id}', [KategoriProActController::class, 'showDetail']);
    Route::post('kategori/proact/update/{id}', [KategoriProActController::class, 'update']);
    // Route::get('kategori/proact/delete/{id}', [KategoriProActController::class, 'delete']);


    // Kategori Speedec
    Route::get('kategori/speed', [KategoriSpeedController::class, 'index']);
    Route::post('kategori/speed/store', [KategoriSpeedController::class, 'store']);
    Route::get('kategori/speed/edit/{id}', [KategoriSpeedController::class, 'showDetail']);
    Route::post('kategori/speed/update/{id}', [KategoriSpeedController::class, 'update']);
    Route::get('kategori/speed/delete/{id}', [KategoriSpeedController::class, 'delete']);

    // Kategori VOC
    Route::get('kategori/voc', [KategoriVOCController::class, 'index']);
    Route::post('kategori/voc/store', [KategoriVOCController::class, 'store']);
    Route::get('kategori/voc/edit/{id}', [KategoriVOCController::class, 'showDetail']);
    Route::post('kategori/voc/update/{id}', [KategoriVOCController::class, 'update']);
    Route::get('kategori/voc/delete/{id}', [KategoriVOCController::class, 'delete']);

    // Kategori XRole
    Route::get('kategori/xrole', [KategoriXRoleController::class, 'index']);
    Route::post('kategori/xrole/store', [KategoriXRoleController::class, 'store']);
    Route::get('kategori/xrole/edit/{id}', [KategoriXRoleController::class, 'showDetail']);
    Route::post('kategori/xrole/update/{id}', [KategoriXRoleController::class, 'update']);
    Route::get('kategori/xrole/delete/{id}', [KategoriXRoleController::class, 'delete']);

    // Kuesioner ProActs
    Route::get('kues/proact', [KuesProActController::class, 'index']);
    Route::get('kues/proact/list/kategori', [KuesProActController::class, 'listKatProAct']);
    Route::get('kues/proact/list/kuesioner', [KuesProActController::class, 'listKuesProAct']);
    Route::post('kues/proact/store', [KuesProActController::class, 'store']);
    Route::get('kues/proact/edit/{id}', [KuesProActController::class, 'showDetail']);
    Route::post('kues/proact/update/{id}', [KuesProActController::class, 'update']);
    Route::get('kues/proact/delete/{id}', [KuesProActController::class, 'delete']);

    // Kuesioner Speedec
    Route::get('kues/speed', [KuesSpeedController::class, 'index']);
    Route::get('kues/speed/list/kategori', [KuesSpeedController::class, 'listKatSpeed']);
    Route::get('kues/speed/list/kuesioner', [KuesSpeedController::class, 'listKuesSpeed']);
    Route::post('kues/speed/store', [KuesSpeedController::class, 'store']);
    Route::get('kues/speed/edit/{id}', [KuesSpeedController::class, 'showDetail']);
    Route::post('kues/speed/update/{id}', [KuesSpeedController::class, 'update']);
    // Route::get('kues/speed/delete/{id}', [KuesSpeedController::class, 'delete']);

    // Kuesioner VOCs
    Route::get('kues/voc', [KuesVOCController::class, 'index']);
    Route::get('kues/voc/list/kategori', [KuesVOCController::class, 'listKatVOC']);
    Route::get('kues/voc/list/kuesioner', [KuesVOCController::class, 'listKuesVOC']);
    Route::post('kues/voc/store', [KuesVOCController::class, 'store']);
    Route::get('kues/voc/edit/{id}', [KuesVOCController::class, 'showDetail']);
    Route::post('kues/voc/update/{id}', [KuesVOCController::class, 'update']);
    // Route::get('kues/voc/delete/{id}', [KuesVOCController::class, 'delete']);

    // Kuesioner Xrole
    Route::get('kues/xrole', [KuesXRoleController::class, 'index']);
    Route::get('kues/xrole/list/kategori', [KuesXRoleController::class, 'listKatXRole']);
    Route::get('kues/xrole/list/kuesioner', [KuesXRoleController::class, 'listKuesXrole']);
    Route::post('kues/xrole/store', [KuesXRoleController::class, 'store']);
    Route::get('kues/xrole/edit/{id}', [KuesXRoleController::class, 'showDetail']);
    Route::post('kues/xrole/update/{id}', [KuesXRoleController::class, 'update']);
    // Route::get('kues/xrole/delete/{id}', [KuesXRoleController::class, 'delete']);

    // Periode Penilian
    Route::get('periode/penilaian', [PeriodePenilaianController::class, 'index']);
    Route::get('periode/penilaian/list', [PeriodePenilaianController::class, 'listPeriode']);
    Route::post('periode/penilaian/store', [PeriodePenilaianController::class, 'store']);
    Route::get('periode/penilaian/edit/{id}', [PeriodePenilaianController::class, 'showDetail']);
    Route::post('periode/penilaian/update/{id}', [PeriodePenilaianController::class, 'update']);
    Route::get('periode/penilaian/delete/{id}', [PeriodePenilaianController::class, 'delete']);


    // Master Penilaian VOCS
    Route::get('vocs/master', [PenilaianVOCController::class, 'master_index']);
    Route::get('vocs/penilai/index/{idMasterPenilaian}', [PenilaianVOCController::class, 'index']);
    Route::get('vocs/penilai/{idPegawai}', [PenilaianVOCController::class, 'penilai']);
    Route::get('vocs/dinilai', [PenilaianVOCController::class, 'dinilai']);
    Route::post('vocs/id/master', [PenilaianVOCController::class, 'getIdMaster']);
    // getIdMaster
    Route::post('vocs/store', [PenilaianVOCController::class, 'store']);
    Route::post('vocs/update/{idMasterPenilaian}', [PenilaianVOCController::class, 'update']);
});
// EXPORT
Route::post('export/{token}', [ExImController::class, 'export']);
Route::get('download/{token}', [ExImController::class, 'download']);
