<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProduksTable extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('umkm_id')->nullable();
            $table->foreign('umkm_id', 'umkm_fk_7979894')->references('id')->on('umkms');
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->foreign('satuan_id', 'satuan_fk_7979903')->references('id')->on('satuan_produks');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id', 'kategori_fk_7979904')->references('id')->on('kategori_produks');
        });
    }
}
