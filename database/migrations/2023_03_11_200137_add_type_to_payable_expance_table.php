<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPayableExpanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
                Schema::table('payable_expance', function (Blueprint $table) {
                    $table->string('type')->after('id');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payable_expance', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
