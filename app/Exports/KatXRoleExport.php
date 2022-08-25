<?php

namespace App\Exports;

use App\Models\KategoriXRole;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

use Illuminate\Support\Facades\DB;

class KatXRoleExport implements FromCollection, WithTitle, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $katxrole = DB::table('kategori_xrole')->select('id','namkat_xrole','status_kategori')->get();
        for ($i = 0; $i < count($katxrole); $i++) {
            if ($katxrole[$i]->status_kategori == 0) {
                $katxrole[$i]->status_kategori = 'Tidak Aktif';
            } else {
                $katxrole[$i]->status_kategori = 'Aktif';
            }
        }
        return $katxrole;
    }

    public function headings(): array
    {
        return [
            'id','namkat_xrole','status_kategori'
        ];
    }

    public function title(): string
    {
        return 'KatXRole';
    }
}
