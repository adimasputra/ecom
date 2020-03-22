<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIkansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('nama_ikan');
            $table->integer('harga');
            $table->string('foto');
            $table->string('berat');
            $table->text('deskripsi');
            $table->integer('tambak_id')->unsigned();

            $table->foreign('tambak_id')->references('id')->on('tambak')->onUpdate('cascade');
            
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
        Schema::dropIfExists('ikans');
    }
}
