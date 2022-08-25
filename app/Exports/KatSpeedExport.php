<?php

namespace App\Exports;

use App\Models\KategoriSpeed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class KatSpeedExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $katspeed = DB::table('kategori_speedec')->select('id','namkat_speed','status_kategori')->get();
        for ($i = 0; $i < count($katspeed); $i++) {
            if ($katspeed[$i]->status_kategori == 0) {
                $katspeed[$i]->status_kategori = 'Tidak Aktif';
            } else {
                $katspeed[$i]->status_kategori = 'Aktif';
            }
        }
        return $katspeed;
    }

    public function headings(): array
    {
        return [
            'id','namkat_speed','status_kategori'
        ];
    }

    public function title(): string
    {
        return 'KatSpeed';
    }
}
