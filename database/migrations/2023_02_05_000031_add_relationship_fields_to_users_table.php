<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('tempat_lahir_id')->nullable();
            $table->foreign('tempat_lahir_id', 'tempat_lahir_fk_7979809')->references('id')->on('kota');
        });
    }
}
