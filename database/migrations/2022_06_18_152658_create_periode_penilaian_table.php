<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periode_penilaian', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('periode');
            $table->date('waktu_terbit');
            $table->date('waktu_penutupan');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periode_penilaian');
    }
}
