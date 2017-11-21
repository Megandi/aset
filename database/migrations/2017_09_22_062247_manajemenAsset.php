<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManajemenAsset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('manajemen_asset', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('parent');
          $table->string('nama');
          $table->integer('status');
          $table->integer('header');
          $table->string('keterangan');
          $table->string('foto');
          $table->string('user_last_updated');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('manajemen_asset');
    }
}
