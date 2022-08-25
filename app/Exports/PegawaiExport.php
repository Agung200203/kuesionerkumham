<?php

namespace App\Exports;

use App\Models\Pegawai;
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

class PegawaiExport extends DefaultValueBinder implements FromCollection, WithTitle, WithHeadings, WithStrictNullComparison, WithCustomValueBinder, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pegawai = DB::table('pegawai')->join('jabatan', 'pegawai.id_jabatan', '=', 'jabatan.id')->join('upt', 'pegawai.id_upt', '=', 'upt.id')->join('wilayah', 'pegawai.id_wilayah', '=', 'wilayah.id')->select('pegawai.nip', 'pegawai.nama', 'pegawai.tgl_lahir', 'pegawai.pendidikan', 'pegawai.gender', 'pegawai.id_jabatan', 'jabatan.nama as jabatan', 'pegawai.id_upt', 'upt.nama as upt', 'pegawai.id_wilayah', 'wilayah.nama as wilayah', 'pegawai.id_atasan', 'pegawai.no_telp', 'pegawai.alamat', 'pegawai.foto', 'pegawai.status_pegawai')->get();
        for ($i = 0; $i < count($pegawai); $i++) {
            if ($pegawai[$i]->status_pegawai == 0) {
                $pegawai[$i]->status_pegawai = 'Tidak Aktif';
            } else {
                $pegawai[$i]->status_pegawai = 'Aktif';
            }
        }

        return $pegawai;
    }

    public function headings(): array
    {
        return [
            'nip', 'nama', 'tgl_lahir', 'pendidikan', 'gender', 'id_jabatan', 'jabatan', 'id_upt', 'upt', 'id_wilayah', 'wilayah', 'id_atasan', 'no_telp', 'alamat', 'foto', 'status_pegawai'
        ];
    }

    public function title(): string
    {
        return 'Pegawai';
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        if ($cell->getColumn() == 'M') {
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
            'M' => '@',
        ];
    }
}
