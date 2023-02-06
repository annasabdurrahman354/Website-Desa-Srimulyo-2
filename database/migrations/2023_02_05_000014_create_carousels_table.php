<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('link_tujuan')->nullable();
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
