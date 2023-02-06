<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukHukumsTable extends Migration
{
    public function up()
    {
        Schema::create('produk_hukums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->string('jenis');
            $table->integer('tahun');
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
