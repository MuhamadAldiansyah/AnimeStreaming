<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngoingSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('ongoing_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id')->constrained('anime');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ongoing_schedule');
    }
}
