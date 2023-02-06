<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUmkmsTable extends Migration
{
    public function up()
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->unsignedBigInteger('pemilik_id')->nullable();
            $table->foreign('pemilik_id', 'pemilik_fk_7979867')->references('id')->on('users');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id', 'kategori_fk_7979882')->references('id')->on('kategori_umkms');
        });
    }
}
