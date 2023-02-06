<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisLayananSyaratLayananPivotTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_layanan_syarat_layanan', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_layanan_id');
            $table->foreign('jenis_layanan_id', 'jenis_layanan_id_fk_7979929')->references('id')->on('jenis_layanans')->onDelete('cascade');
            $table->unsignedBigInteger('syarat_layanan_id');
            $table->foreign('syarat_layanan_id', 'syarat_layanan_id_fk_7979929')->references('id')->on('syarat_layanans')->onDelete('cascade');
        });
    }
}
