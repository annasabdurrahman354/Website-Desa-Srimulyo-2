<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPelayanansTable extends Migration
{
    public function up()
    {
        Schema::create('berkas_pelayanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teks_syarat')->nullable();
            $table->string('status');
            $table->string('catatan_reviewer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
