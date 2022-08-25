<?php

namespace App\Exports;

use App\Models\PeriodePenilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class PeriodePenilaianExport implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $periodepenilaian = DB::table('periode_penilaian')->select('bulan','tahun','periode','waktu_terbit','waktu_penutupan','status')->get();
        return $periodepenilaian;
    }

    public function headings(): array
    {
        return [
            'bulan','tahun','periode','waktu_terbit','waktu_penutupan','status'
        ];
    }

    public function title(): string
    {
        return 'Periode Penilaian';
    }
}
