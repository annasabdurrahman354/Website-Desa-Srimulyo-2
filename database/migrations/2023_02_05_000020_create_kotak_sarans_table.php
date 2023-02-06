<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKotakSaransTable extends Migration
{
    public function up()
    {
        Schema::create('kotak_sarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pengirim')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->longText('isi');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
