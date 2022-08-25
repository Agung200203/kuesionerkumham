<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianproact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaianproact', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('kuesioner_id')->unsigned();
            $table->foreign('kuesioner_id')->references('id')->on('kuesioner_proact')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->bigInteger('id_master')->unsigned();
            $table->foreign('id_master')->references('id')->on('master_penilaianproact')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->longText('jawaban')->nullable();
            $table->integer("rating")->default(0);
            $table->integer("nilaiTerbobot")->default(0);
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
        Schema::dropIfExists('penilaianproact');
    }
}
