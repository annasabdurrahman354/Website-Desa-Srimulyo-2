<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyaratLayanansTable extends Migration
{
    public function up()
    {
        Schema::create('syarat_layanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->unique();
            $table->string('jenis_berkas');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
