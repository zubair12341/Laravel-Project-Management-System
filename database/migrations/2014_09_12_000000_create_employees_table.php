<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_no')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('date_of_birth')->nullable();
            $table->string('gender');
            $table->string('marital_status')->nullable();
            $table->string('qualification')->nullable();
            $table->string('cnic')->unique()->nullable();
            $table->string('mobile_no')->unique();
            $table->string('home_phone')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('other_email')->nullable();
            $table->string('country')->nullable();
            $table->string('province_state')->nullable();
            $table->string('city')->nullable();
            $table->string('nationality')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('profile_image')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
