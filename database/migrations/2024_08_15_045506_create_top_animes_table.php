<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopAnimesTable extends Migration
{
    public function up()
    {
        Schema::create('top_animes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime');
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('top_animes');
    }
}
