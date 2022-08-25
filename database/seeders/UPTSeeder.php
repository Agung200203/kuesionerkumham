<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UPTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $limit = 20;
    	for($i = 1; $i <= $limit; $i++){
    		DB::table('upt')->insert([
    			'kode' => $faker->numerify('#########'),
    			'nama' => $faker->randomElement(['Kanwil', 'Bapas', 'KanImi', 'Lapas', 'Rutan', 'LemPim', 'Rupbasan']) . $faker->randomElement(['1','2','3','4','5','6','7','8','9','Cabang']),
                'alamat' => $faker->address(),
                'kapupt' => $faker->name(),
                'email' => $faker->email(),
                'no_telp' => $faker->numerify('08########'),
                'id_wil' => $faker->numberBetween(1,$limit),
    			'status_upt' => 1,
                "created_at" =>  Carbon::now(), # new \Datetime()
                "updated_at" => Carbon::now(),  # new \Datetime()
    		]);
    	}
    }
}
