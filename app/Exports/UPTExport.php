<?php

namespace App\Exports;

use App\Models\UPT;
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

class UPTExport extends DefaultValueBinder implements FromCollection, WithTitle, WithHeadings, WithStrictNullComparison, WithCustomValueBinder, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $upt = DB::table('upt')->join('wilayah', 'upt.id_wil', '=', 'wilayah.id')->select('upt.kode', 'upt.nama', 'upt.alamat', 'upt.kapupt', 'upt.email', 'upt.no_telp', 'upt.id_wil', 'wilayah.nama as wilayah', 'upt.status_upt')->get();
        for ($i = 0; $i < count($upt); $i++) {
            if ($upt[$i]->status_upt == 0) {
                $upt[$i]->status_upt = 'Tidak Aktif';
            } else {
                $upt[$i]->status_upt = 'Aktif';
            }
        }

        return $upt;
    }

    public function headings(): array
    {
        return [
            'kode', 'nama', 'alamat', 'kapupt', 'email', 'no_telp', 'id_wil', 'wilayah', 'status_upt'
        ];
    }

    public function title(): string
    {
        return 'UPT';
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        if ($cell->getColumn() == 'F') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function columnFormats(): array
    {
        return [
            'A' => '@',
            'F' => '@',
        ];
    }
}
