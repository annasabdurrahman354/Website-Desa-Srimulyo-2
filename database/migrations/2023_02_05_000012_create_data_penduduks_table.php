<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenduduksTable extends Migration
{
    public function up()
    {
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->integer('tahun_pembaruan');
            $table->longText('deskripsi');
            $table->boolean('is_grafik')->default(0)->nullable();
            $table->boolean('is_tabel')->default(0)->nullable();
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
