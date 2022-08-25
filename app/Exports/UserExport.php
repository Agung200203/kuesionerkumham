<?php

namespace App\Exports;

use App\Models\User;
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

class UserExport extends DefaultValueBinder implements FromCollection, WithTitle, WithHeadings, WithStrictNullComparison, WithCustomValueBinder, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = DB::table('users')->join('pegawai', 'users.id_pegawai', '=', 'pegawai.id')->select('users.email','users.email_verified_at','users.password','users.lvl_user','users.id_pegawai','pegawai.nama as nama_pegawai','users.status')->get();
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->status == 0) {
                $users[$i]->status = 'Tidak Aktif';
            } else {
                $users[$i]->status = 'Aktif';
            }
        }

        return $users;
    }

    public function headings(): array
    {
        return [
            'email','email_verified_at','password','lvl_user','id_pegawai','nama_pegawai','status'
        ];
    }

    public function title(): string
    {
        return 'Users';
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'D') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function columnFormats(): array
    {
        return ['D' => '@'];
    }
}
