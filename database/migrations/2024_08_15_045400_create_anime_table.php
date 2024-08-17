<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeTable extends Migration
{
    public function up()
    {
        Schema::create('anime', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->boolean('is_top_anime')->default(false);
            $table->string('poster')->nullable()->after('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anime');
    }
}
