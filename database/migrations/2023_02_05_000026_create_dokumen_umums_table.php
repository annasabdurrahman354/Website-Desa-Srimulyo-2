<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenUmumsTable extends Migration
{
    public function up()
    {
        Schema::create('dokumen_umums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->integer('tahun_terbit');
            $table->longText('deskripsi');
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
