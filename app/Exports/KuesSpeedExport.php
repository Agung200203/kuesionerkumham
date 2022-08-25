<?php

namespace App\Exports;

use App\Models\KuesionerSpeed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class KuesSpeedExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kues = DB::table('kuesioner_speedec')->join('kategori_speedec', 'kuesioner_speedec.id_katspeed', '=', 'kategori_speedec.id')->select('kuesioner_speedec.id', 'kuesioner_speedec.id_katspeed','kategori_speedec.namkat_speed as katspeed','kuesioner_speedec.namkuesspeed','kuesioner_speedec.bobot','kuesioner_speedec.kpd_role','kuesioner_speedec.status_kuesioner')->get();
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
            'id', 'id_katspeed','katspeed','namkuesspeed','bobot','kpd_role','status_kuesioner'
        ];
    }

    public function title(): string
    {
        return 'KuesSpeeDec';
    }
}
