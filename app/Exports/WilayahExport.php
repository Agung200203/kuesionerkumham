<?php

namespace App\Exports;

use App\Models\Wilayah;
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

class WilayahExport extends DefaultValueBinder implements FromCollection, WithTitle, WithHeadings, WithStrictNullComparison, WithCustomValueBinder, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $wil = DB::table('wilayah')->select('id','nama', 'alamat', 'kakanwil', 'email', 'no_telp', 'status_wilayah')->get();
        for ($i = 0; $i < count($wil); $i++) {
            if ($wil[$i]->status_wilayah == 0) {
                $wil[$i]->status_wilayah = 'Tidak Aktif';
            } else {
                $wil[$i]->status_wilayah = 'Aktif';
            }
        }

        return $wil;
    }

    public function headings(): array
    {
        return [
            'id','nama', 'alamat', 'kakanwil', 'email', 'no_telp', 'status_wilayah'
        ];
    }

    public function title(): string
    {
        return 'Wilayah';
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'F') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function columnFormats(): array
    {
        return ['F' => '@'];
    }
}
