<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontaksTable extends Migration
{
    public function up()
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->unique();
            $table->string('kontak');
            $table->string('jenis_kontak');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
