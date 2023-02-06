<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisLayanansTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_layanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->unique();
            $table->longText('deskripsi');
            $table->decimal('biaya', 15, 2);
            $table->boolean('pelayanan_online')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
