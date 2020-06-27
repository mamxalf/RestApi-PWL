<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('schedule_id');
            $table->bigInteger('fotografer_id')->unsigned()->nullable();
            $table->bigInteger('classroom_id')->unsigned()->nullable();
            $table->text('location');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['FINISH', 'PROCESS']);
            $table->timestamps();

            $table->foreign('fotografer_id')->references('fotografer_id')->on('fotografers')->onDelete('cascade');
            $table->foreign('classroom_id')->references('classroom_id')->on('classrooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
