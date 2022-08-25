<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionerProactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_proact', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_katproacts')->unsigned();
            $table->foreign('id_katproacts')->references('id')->on('kategori_proact')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->text('namkuesproacts')->required();
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
        Schema::dropIfExists('kuesioner_proact');
    }
}
