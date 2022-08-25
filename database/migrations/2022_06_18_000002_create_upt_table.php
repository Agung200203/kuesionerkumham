<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode', 10);
            $table->string('nama');
            $table->text('alamat');
            $table->string('kapupt');
            $table->string('email');
            $table->string('no_telp',15);
            $table->bigInteger('id_wil')->unsigned();
            $table->foreign('id_wil')->references('id')->on('wilayah')->onDelete('CASCADE');
            $table->boolean('status_upt')->default(1);
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
        Schema::dropIfExists('upt');
    }
}
