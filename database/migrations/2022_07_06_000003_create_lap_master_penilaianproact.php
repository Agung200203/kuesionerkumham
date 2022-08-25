<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapMasterPenilaianproact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lap_master_penilaianproact', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('tahun');
            $table->bigInteger('id_pegawai')->unsigned();
            $table->bigInteger('id_jab')->unsigned();
            $table->bigInteger('id_upt')->unsigned();
            $table->bigInteger('id_wil')->unsigned();
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_jab')->references('id')->on('jabatan')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_upt')->references('id')->on('upt')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_wil')->references('id')->on('wilayah')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('total')->default(0);
            $table->integer('sub1')->default(0);
            $table->integer('sub2')->default(0);
            $table->integer('sub3')->default(0);
            $table->integer('sub4')->default(0);
            $table->integer('sub5')->default(0);
            $table->integer('sub6')->default(0);
            $table->integer('sub7')->default(0);
            $table->integer('sub8')->default(0);
            $table->integer('sub9')->default(0);
            $table->integer('sub10')->default(0);
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
        Schema::dropIfExists('lap_master_penilaianproact');
    }
}
