<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JabatanSeeder extends Seeder
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
    		DB::table('jabatan')->insert([
    			'kode_jabatan' => $faker->postcode(),
    			'nama' => $faker->jobTitle,
    			'status_jabatan' => 1,
                "created_at" =>  Carbon::now(), # new \Datetime()
                "updated_at" => Carbon::now(),  # new \Datetime()
    		]);
    	}
    }
}
