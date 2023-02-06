<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->unsignedBigInteger('penulis_id')->nullable();
            $table->foreign('penulis_id', 'penulis_fk_7979826')->references('id')->on('users');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id', 'kategori_fk_7979833')->references('id')->on('kategori_artikels');
        });
    }
}
