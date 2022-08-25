<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionerSpeedecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_speedec', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_katspeed')->unsigned();
            $table->foreign('id_katspeed')->references('id')->on('kategori_speedec')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->text('namkuesspeed')->required();
            $table->integer('bobot');
            $table->integer('kpd_role')->comment('1=atas,2=sejawat,3=bawahan,4=dirinya');
            $table->boolean('status_kuesioner');
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
        Schema::dropIfExists('kuesioner_speedec');
    }
}
