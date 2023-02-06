<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBerkasPelayanansTable extends Migration
{
    public function up()
    {
        Schema::table('berkas_pelayanans', function (Blueprint $table) {
            $table->unsignedBigInteger('pelayanan_id')->nullable();
            $table->foreign('pelayanan_id', 'pelayanan_fk_7979943')->references('id')->on('pelayanans');
            $table->unsignedBigInteger('syarat_layanan_id')->nullable();
            $table->foreign('syarat_layanan_id', 'syarat_layanan_fk_7979944')->references('id')->on('syarat_layanans');
        });
    }
}
