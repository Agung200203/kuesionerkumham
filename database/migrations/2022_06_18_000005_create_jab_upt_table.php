<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJabUptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jab_upt', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jab_id')->unsigned();
            // $table->bigInteger('bag_id')->unsigned();
            $table->bigInteger('upt_id')->unsigned();
            $table->bigInteger('wil_id')->unsigned();

            $table->bigInteger('jab_atas_id')->unsigned()->nullable();
            // $table->bigInteger('bag_atas_id')->unsigned();
            $table->bigInteger('upt_atas_id')->unsigned()->nullable();
            $table->bigInteger('wil_atas_id')->unsigned()->nullable();
            $table->integer('hub_sejawat')->unsigned()->nullable();

            $table->bigInteger('jab_puk')->unsigned()->nullable();
            // $table->bigInteger('bag_puk')->unsigned();
            $table->bigInteger('upt_puk')->unsigned()->nullable();
            $table->bigInteger('wil_puk')->unsigned()->nullable();

            $table->integer('status')->unsigned();
            $table->timestamps();

            /**
             * ? PUK = Penilai Utama Karyawan
             * TODO: setiap foreign key harus mengenerate data-data master dahulu baru di sinkron relasinya ~_^
             */
            $table->foreign('jab_id')->references('id')->on('jabatan')->onDelete('CASCADE');
            // $table->foreign('bag_id')->references('id')->on('jabatan')->onDelete('CASCADE');
            $table->foreign('upt_id')->references('id')->on('upt')->onDelete('CASCADE');
            $table->foreign('wil_id')->references('id')->on('wilayah')->onDelete('CASCADE');
            $table->foreign('jab_atas_id')->references('id')->on('jabatan')->onDelete('CASCADE');
            // $table->foreign('bag_atas_id')->references('id')->on('jabatan')->onDelete('CASCADE');
            $table->foreign('upt_atas_id')->references('id')->on('upt')->onDelete('CASCADE');
            $table->foreign('wil_atas_id')->references('id')->on('wilayah')->onDelete('CASCADE');
            $table->foreign('jab_puk')->references('id')->on('jabatan')->onDelete('CASCADE');
            // $table->foreign('bag_puk')->references('id')->on('jabatan')->onDelete('CASCADE');
            $table->foreign('upt_puk')->references('id')->on('upt')->onDelete('CASCADE');
            $table->foreign('wil_puk')->references('id')->on('wilayah')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jab_upt');
    }
}
