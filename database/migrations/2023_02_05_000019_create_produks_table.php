<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('slug')->unique();
            $table->longText('deskripsi');
            $table->decimal('harga', 15, 2);
            $table->boolean('is_tersedia')->default(0)->nullable();
            $table->boolean('is_tampilkan')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
