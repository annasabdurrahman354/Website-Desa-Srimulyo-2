<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmsTable extends Migration
{
    public function up()
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_umkm');
            $table->string('slug')->unique();
            $table->longText('deskripsi');
            $table->string('nomor_telepon')->nullable();
            $table->string('alamat');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->datetime('waktu_keterlihatan')->nullable();
            $table->boolean('is_aktif')->default(0)->nullable();
            $table->boolean('is_terverifikasi')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
