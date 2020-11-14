<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->Increments('services_id');
            $table->Integer('Status')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->Integer('customer_id')->unsigned();
            $table->Integer('product_id')->unsigned();
            $table->Integer('Action')->default(0);
            $table->BigInteger('installation_engineer_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->Integer('company_id')->unsigned();
        });
        Schema::table('services',function (Blueprint $table){
            $table->foreign('installation_engineer_id')->references('id')->on('users');
        });
        Schema::table('services',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
