<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_invoice_id')->references('id')->on('client_invoices')->onDelete('cascade');
            $table->string('description');
            $table->integer('quantity');
            $table->float('rate', 8,2);
            $table->float('total', 8,2);
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
        Schema::dropIfExists('client_invoice_details');
    }
}
