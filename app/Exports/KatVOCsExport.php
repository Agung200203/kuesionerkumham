<?php

namespace App\Exports;

use App\Models\KategoriVOCs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class KatVOCsExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $katvocs = DB::table('kategori_vocs')->select('id','namkat_vocs','status_kategori')->get();
        for ($i = 0; $i < count($katvocs); $i++) {
            if ($katvocs[$i]->status_kategori == 0) {
                $katvocs[$i]->status_kategori = 'Tidak Aktif';
            } else {
                $katvocs[$i]->status_kategori = 'Aktif';
            }
        }
        return $katvocs;
    }

    public function headings(): array
    {
        return [
            'id','namkat_vocs','status_kategori'
        ];
    }

    public function title(): string
    {
        return 'KatVOCs';
    }
}
