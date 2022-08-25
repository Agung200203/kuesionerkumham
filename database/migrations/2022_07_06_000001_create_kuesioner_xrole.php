<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionerXrole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_xrole', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_katxrole')->unsigned();
            $table->foreign('id_katxrole')->references('id')->on('kategori_xrole')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->text('namkuesxrole')->required();
            $table->bigInteger('bobot');
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
        Schema::dropIfExists('kuesioner_xrole');
    }
}
