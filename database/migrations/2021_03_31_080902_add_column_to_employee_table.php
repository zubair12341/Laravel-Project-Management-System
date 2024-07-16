<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('designation_id')->after('profile_image');
            $table->date('probation_period_start')->nullable()->after('designation_id');
            $table->date('probation_period_end')->nullable()->after('probation_period_start');
            $table->float('salary', 8,2)->nullable()->after('probation_period_end');
            $table->date('joining_date')->nullable()->after('salary');
            $table->date('ending_date')->nullable()->after('joining_date');
            $table->unsignedBigInteger('employee_id')->after('ending_date');
            $table->time('working_time_start')->nullable()->after('employee_id');
            $table->time('working_time_end')->nullable()->after('working_time_start');
            $table->string('job_status')->after('working_time_end');
            $table->date('termination_date')->nullable()->after('job_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->unsignedBigInteger('designation_id')->after('profile_image');
            $table->date('probation_period_start')->nullable()->after('designation_id');
            $table->date('probation_period_end')->nullable()->after('probation_period_start');
            $table->float('salary', 8,2)->nullable()->after('probation_period_end');
            $table->date('joining_date')->nullable()->after('salary');
            $table->date('ending_date')->nullable()->after('joining_date');
            $table->unsignedBigInteger('employee_id')->after('ending_date');
            $table->time('working_time_start')->nullable()->after('employee_id');
            $table->time('working_time_end')->nullable()->after('working_time_start');
            $table->string('job_status')->after('working_time_end');
            $table->date('termination_date')->nullable()->after('job_status');
        });
    }
}
