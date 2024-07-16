<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_service_name')->nullable();
            $table->string('service_provider_name')->nullable();
            $table->string('acc_source')->nullable();
            $table->date('domain_exp_date')->nullable();
            $table->string('website_status')->nullable();
            $table->date('website_setup_date')->nullable();
            $table->date('ssl_apply_date')->nullable();
            $table->string('hosting_name')->nullable();
            $table->string('domain_renewl_status')->nullable();
            $table->string('cpanel_url')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('client_url')->nullable();
            $table->string('c_username')->nullable();
            $table->string('c_password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
