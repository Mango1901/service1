<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->Increments('customer_id');
            $table->String('customer_name');
            $table->String('customer_email');
            $table->String('customer_address');
            $table->String('customer_phone');
            $table->String('customer_contact');
            $table->Integer('Action')->default(0);
            $table->Integer('company_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('services',function (Blueprint $table){
            $table->foreign('customer_id')->references('customer_id')->on('customers');
        });
        Schema::table('customers',function (Blueprint $table){
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
        Schema::dropIfExists('customers');
    }
}
