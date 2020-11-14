<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->Increments('company_id');
            $table->String('company_name',150);
            $table->timestamps();
        });
        Schema::table('users',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('services',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('warranty_details',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('customers',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('categories',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('products',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
        Schema::table('store_images',function (Blueprint $table){
            $table->foreign('company_id')->references('company_id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
