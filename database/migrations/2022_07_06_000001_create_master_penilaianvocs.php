<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPenilaianvocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_penilaianvocs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_user_penilai')->unsigned();
            $table->bigInteger('id_user_pegawai')->unsigned();
            $table->bigInteger('id_periode')->unsigned();
            $table->foreign('id_user_penilai')->references('id')->on('pegawai')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_user_pegawai')->references('id')->on('pegawai')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('id_periode')->references('id')->on('periode_penilaian')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('status');
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
        Schema::dropIfExists('master_penilaianvocs');
    }
}
