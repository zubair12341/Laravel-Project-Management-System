<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeBreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_breaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_tracker_id')->references('id')->on('time_tracker')->onDelete('cascade');
            $table->foreignId('employee_id')->references('id')->on('time_breaks')->onDelete('cascade');
            $table->date('date');
            $table->dateTime('breakin');
            $table->dateTime('breakout')->nullable();
            $table->time('total_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_breaks');
    }
}
