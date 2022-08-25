<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nip',20)->unique();
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->date('tgl_masuk')->nullable();
            $table->string('pendidikan',5)->comment('SMA,SMK,MA,Dn,Sn,PSn,MLTS');
            $table->string('gender',1);
            $table->bigInteger('id_jabatan')->unsigned();
            $table->bigInteger('id_upt')->unsigned();
            $table->bigInteger('id_wilayah')->unsigned();
            $table->bigInteger('id_jab_upt')->unsigned();
            $table->bigInteger('id_atasan')->unsigned()->nullable();
            $table->string('no_telp',15);
            $table->string('alamat', 255);
            $table->string('foto')->nullable();
            $table->boolean('status_pegawai')->default(1);
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('CASCADE');
            $table->foreign('id_upt')->references('id')->on('upt')->onDelete('CASCADE');
            $table->foreign('id_wilayah')->references('id')->on('wilayah')->onDelete('CASCADE');
            $table->foreign('id_jab_upt')->references('id')->on('jab_upt')->onDelete('CASCADE');
            $table->foreign('id_atasan')->references('id')->on('pegawai')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
