<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('creater_id');
            $table->unSignedBigInteger('lead_id');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status');
            $table->string('technology')->nullable();
            $table->string('website')->nullable();
            $table->string('service')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
