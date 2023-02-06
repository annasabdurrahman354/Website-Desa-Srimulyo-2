<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPelayanansTable extends Migration
{
    public function up()
    {
        Schema::table('pelayanans', function (Blueprint $table) {
            $table->unsignedBigInteger('pemohon_id')->nullable();
            $table->foreign('pemohon_id', 'pemohon_fk_7979932')->references('id')->on('users');
            $table->unsignedBigInteger('jenis_layanan_id')->nullable();
            $table->foreign('jenis_layanan_id', 'jenis_layanan_fk_7979933')->references('id')->on('jenis_layanans');
        });
    }
}
