<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAparaturDesasTable extends Migration
{
    public function up()
    {
        Schema::create('aparatur_desas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('posisi');
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
