<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriUmkmsTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_umkms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kategori')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
