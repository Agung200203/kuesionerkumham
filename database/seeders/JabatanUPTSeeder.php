<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JabatanUPT;

class JabatanUPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jab_id = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $wil_id = [1, 2, 2, 2, 3, 3, 3, 4, 4, 4];
        $upt_id = [1, 2, 2, 2, 3, 3, 3, 4, 4, 4];
        $jab_atasan = [null, 1, 1, 1, 3, 3, 3, 5, null, null];
        $wil_atasan = [null, 1, 1, 1, 2, 2, 2, 3, null, null];
        $upt_atasan = [null, 1, 1, 1, 2, 2, 2, 3, null, null];

        for ($i=0; $i < count($jab_id); $i++) { 
            JabatanUPT::create([
                'jab_id' => $jab_id[$i],
                'upt_id' => $upt_id[$i],
                'wil_id' => $wil_id[$i],
                'jab_atas_id' => $jab_atasan[$i],
                'upt_atas_id' => $upt_atasan[$i],
                'wil_atas_id' => $wil_atasan[$i],
                'hub_sejawat' => 1,
                'status' => 1,
            ]);
        }
    }
}
