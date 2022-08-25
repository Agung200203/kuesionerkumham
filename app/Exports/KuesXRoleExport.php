<?php

namespace App\Exports;

use App\Models\KuesionerXRole;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class KuesXRoleExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kues = DB::table('kuesioner_xrole')->join('kategori_xrole', 'kuesioner_xrole.id_katxrole', '=', 'kategori_xrole.id')->select('kuesioner_xrole.id', 'kuesioner_xrole.id_katxrole','kategori_xrole.namkat_xrole as katxrole','kuesioner_xrole.namkuesxrole','kuesioner_xrole.bobot','kuesioner_xrole.kpd_role','kuesioner_xrole.status_kuesioner')->get();
        for ($i = 0; $i < count($kues); $i++) {
            // KEPADA ROLE
            if ($kues[$i]->kpd_role == 1) {
                $kues[$i]->kpd_role = 'Atasan';
            } else if($kues[$i]->kpd_role == 2) {
                $kues[$i]->kpd_role = 'Sejawat';
            } else if($kues[$i]->kpd_role == 3) {
                $kues[$i]->kpd_role = 'Bawahan';
            } else if($kues[$i]->kpd_role == 4) {
                $kues[$i]->kpd_role = 'Diri Sendiri';
            }
            // STATUS KUESIONER
            if ($kues[$i]->status_kuesioner == 0) {
                $kues[$i]->status_kuesioner = 'Tidak Aktif';
            } else {
                $kues[$i]->status_kuesioner = 'Aktif';
            }
        }

        return $kues;
    }

    public function headings(): array
    {
        return [
            'id', 'id_katxrole','katxrole','namkuesxrole','bobot','kpd_role','status_kuesioner'
        ];
    }

    public function title(): string
    {
        return 'KuesXRole';
    }
}
