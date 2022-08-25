<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class WilayahSeeder extends Seeder
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
    		DB::table('wilayah')->insert([
    			'nama' => $faker->city(),
    			'alamat' => $faker->address(),
                'kakanwil' => $faker->name(),
                'email' => $faker->email(),
                'no_telp' => $faker->numerify('08########'),
                'status_wilayah' => 1,
                "created_at" =>  Carbon::now(), # new \Datetime()
                "updated_at" => Carbon::now(),  # new \Datetime()
    		]);
    	}
    }
}
