<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime');
            $table->integer('episode_number');
            $table->string('description')->nullable(); // Nullable field
            $table->string('video_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
