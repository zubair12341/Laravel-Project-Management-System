<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInternshipToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->date('internship_period_start')->nullable()->after('probation_period_end');
            $table->date('internship_period_end')->nullable()->after('internship_period_start');
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
            $table->date('internship_period_start')->nullable()->after('probation_period_end');
            $table->date('internship_period_end')->nullable()->after('internship_period_start');
        });
    }
}
