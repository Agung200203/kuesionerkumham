<?php

namespace App\Exports;

use App\Models\KategoriProAct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

use Illuminate\Support\Facades\DB;

class KatProActExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $katproact = DB::table('kategori_proact')->select('id','namkat_proact','status_kategori')->get();
        for ($i = 0; $i < count($katproact); $i++) {
            if ($katproact[$i]->status_kategori == 0) {
                $katproact[$i]->status_kategori = 'Tidak Aktif';
            } else {
                $katproact[$i]->status_kategori = 'Aktif';
            }
        }
        return $katproact;
    }

    public function headings(): array
    {
        return [
            'id','namkat_proact','status_kategori'
        ];
    }

    public function title(): string
    {
        return 'KatProAct';
    }
}
