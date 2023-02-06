<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelayanansTable extends Migration
{
    public function up()
    {
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode')->unique();
            $table->string('catatan_pemohon')->nullable();
            $table->string('catatan_reviewer')->nullable();
            $table->string('status');
            $table->string('rating')->nullable();
            $table->longText('penilaian_pemohon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
