<?php

namespace App\Exports;

use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class JabatanExport implements FromCollection, WithTitle, WithHeadings//, WithStrictNullComparison, WithColumnFormatting, WithCustomValueBinder, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $jabatan = Jabatan::select('id', 'kode_jabatan', 'nama', 'status_jabatan')->get();
        for ($i = 0 ; $i < count($jabatan); $i++){
            if($jabatan[$i]->status_jabatan == 0){
                $jabatan[$i]->status_jabatan = 'Tidak Aktif';
            } else {
                $jabatan[$i]->status_jabatan = 'Aktif';
            }
        }
        return $jabatan;

        // return Jabatan::select('id', 'kode_jabatan', 'nama', 'status_jabatan')->get();
    }

    public function headings(): array
    {
        return [
            'id', 'kode_jabatan', 'nama', 'status_jabatan'
        ];
    }

    public function title(): string
    {
        return 'Jabatan';
    }
}
