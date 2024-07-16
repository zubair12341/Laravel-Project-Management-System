<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->date('from_date');
            $table->date('to_date');
            $table->float('discount', 8,2);
            $table->float('grand_total', 8,2);
            $table->text('notes');
            $table->foreignId('task_module_id')->references('id')->on('task_modules')->onDelete('cascade');
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
        Schema::dropIfExists('client_invoices');
    }
}
