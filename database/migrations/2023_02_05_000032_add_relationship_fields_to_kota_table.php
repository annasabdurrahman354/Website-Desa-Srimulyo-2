<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKotaTable extends Migration
{
    public function up()
    {
        Schema::table('kota', function (Blueprint $table) {
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->foreign('provinsi_id', 'provinsi_fk_7979798')->references('id')->on('provinsis');
        });
    }
}
