<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

trait ApiTools{
    // public function dataAuthUser($data){
    //     return [
    //         "user" => auth()->user(),
    //         "data" => $data
    //     ];
    // }
    public function p_spam($message)
    {
        return response()->json($message);
    }
    public function successResponse($data, $code)
    {
        return response()->json(['user'=>auth()->user(), 'data'=>$data], $code);
    }

    public function errorResponse($message, $code)
    {
        return response()->json(['msg' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200, $defaultPage = 20)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
            // return $this->successResponse(['user'=>auth()->user(), 'data' => $collection], $code);
        }

//        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection, $defaultPage);
//        $collection = $this->cacheResponse($collection);

        return $this->successResponse($collection, $code);
    }

    protected function showAllDesc(Collection $collection, $code = 200, $defaultPage = 20)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }

//        $collection = $this->filterData($collection);
        $collection = $this->sortDataDesc($collection);
        $collection = $this->paginate($collection, $defaultPage);
//        $collection = $this->cacheResponse($collection);

        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }

    protected function showData($data, $code = 200)
    {
        return $this->successResponse($data, $code);
    }

    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['msg' => $message, 'code' => $code], $code);
    }

    // protected function filterData(Collection $collection)
    // {
    //     foreach (request()->query() as $query => $value) {
    //         $attribute = $query;
    //         if (isset($attribute, $value)) {
    //             $collection = $collection->where($attribute, $value);
    //         }
    //     }

    //     return $collection;
    // }

    protected function sortData(Collection $collection)
    {
        // Harus ada request['sort_by'] yang merujuk pada attribut tabel
        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
    }

    protected function sortDataDesc(Collection $collection)
    {
        if (request()->has('sort_by')) {
            $attribute = request()->sort_by;
            $collection = $collection->sortByDesc->{$attribute};
        }
        return $collection;
    }

    protected function paginate(Collection $collection, $defaultPage = 20)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50'
        ];

        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = $defaultPage;

        if (request()->has('per_page')) {
            $perPage = (int)request()->per_page;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }

    /**
     * Get Status Role dari id penilai dan yang dinilai sesuai dengan aturan parameter
     * @param penilai integer
     * @param dinilai integer
     * @return statusRole integer
     * TODO: $this->getRoleStatus($penilai, $dinilai);
     */
    public function getRoleStatus($penilai_id, $dinilai_id){
        $yang_di_return = null;
        if($penilai_id == $dinilai_id){
            $yang_di_return = 4;
        } else {
            $penilai = DB::table('pegawai')->where('pegawai.id','=',$penilai_id)->join('jab_upt', 'pegawai.id_jab_upt', '=', 'jab_upt.id')->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.tgl_lahir', 'pegawai.tgl_masuk', 'pegawai.pendidikan', 'pegawai.gender', 'pegawai.id_jabatan', 'pegawai.id_upt', 'pegawai.id_wilayah', 'pegawai.id_jab_upt', 'jab_upt.jab_id as tree_jab_id','jab_upt.upt_id as tree_upt_id','jab_upt.wil_id as tree_wil_id','jab_upt.jab_atas_id as tree_jab_atas_id','jab_upt.upt_atas_id as tree_upt_atas_id','jab_upt.wil_atas_id as tree_wil_atas_id','jab_upt.hub_sejawat as tree_hub_sejawat','jab_upt.jab_puk as tree_jab_puk','jab_upt.upt_puk as tree_upt_puk','jab_upt.wil_puk as tree_wil_puk','jab_upt.status as tree_jab_upt_status', 'pegawai.id_atasan', 'pegawai.no_telp', 'pegawai.alamat', 'pegawai.foto', 'pegawai.status_pegawai')->get();
            $dinilai = DB::table('pegawai')->where('pegawai.id','=',$dinilai_id)->join('jab_upt', 'pegawai.id_jab_upt', '=', 'jab_upt.id')->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.tgl_lahir', 'pegawai.tgl_masuk', 'pegawai.pendidikan', 'pegawai.gender', 'pegawai.id_jabatan', 'pegawai.id_upt', 'pegawai.id_wilayah', 'pegawai.id_jab_upt', 'jab_upt.jab_id as tree_jab_id','jab_upt.upt_id as tree_upt_id','jab_upt.wil_id as tree_wil_id','jab_upt.jab_atas_id as tree_jab_atas_id','jab_upt.upt_atas_id as tree_upt_atas_id','jab_upt.wil_atas_id as tree_wil_atas_id','jab_upt.hub_sejawat as tree_hub_sejawat','jab_upt.jab_puk as tree_jab_puk','jab_upt.upt_puk as tree_upt_puk','jab_upt.wil_puk as tree_wil_puk','jab_upt.status as tree_jab_upt_status', 'pegawai.id_atasan', 'pegawai.no_telp', 'pegawai.alamat', 'pegawai.foto', 'pegawai.status_pegawai')->get();

            //1=atas,2=sejawat,3=bawahan,4=dirinya, 0=off & hidden
            if($penilai[0]->tree_jab_atas_id == $dinilai[0]->tree_jab_id && $penilai[0]->tree_upt_atas_id == $dinilai[0]->tree_upt_id && $penilai[0]->tree_wil_atas_id == $dinilai[0]->tree_wil_id){
                $yang_di_return = 3;
            } else if($penilai[0]->tree_jab_id == $dinilai[0]->tree_jab_atas_id && $penilai[0]->tree_upt_id == $dinilai[0]->tree_upt_atas_id && $penilai[0]->tree_wil_id == $dinilai[0]->tree_wil_atas_id){
                $yang_di_return = 1;
            } else if($penilai[0]->tree_jab_atas_id == $dinilai[0]->tree_jab_atas_id && $penilai[0]->tree_upt_atas_id == $dinilai[0]->tree_upt_atas_id && $penilai[0]->tree_wil_atas_id == $dinilai[0]->tree_wil_atas_id && $penilai[0]->tree_hub_sejawat == 1 && $dinilai[0]->tree_hub_sejawat == 1){
                $yang_di_return = 2;
            } else {
                $yang_di_return = "error";
            }
        }
        return $yang_di_return;
    }
}

?>
