<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranty_details', function (Blueprint $table) {
            $table->Increments('warranty_id');
            $table->date('warranty_date');
            $table->time('warranty_hour');
            $table->time('warranty_hour2');
            $table->BigInteger('maintenance_engineer_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->Text('replacement_components')->nullable();
            $table->String('results')->nullable();
            $table->String('warranty_status_error')->nullable();
            $table->text('warranty_cause')->nullable();
            $table->text('warranty_solution')->nullable();
            $table->text('warranty_notes');
            $table->Integer('warranty_status')->unsigned();
            $table->Text('job_details');
            $table->Text('survey_results');
            $table->Integer('services_id')->unsigned();
            $table->Integer('company_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('warranty_details',function (Blueprint $table){
            $table->foreign('maintenance_engineer_id')->references('id')->on('users');
        });
        Schema::table('warranty_details',function (Blueprint $table){
            $table->foreign('services_id')->references('services_id')->on('services');
        });
        Schema::table('warranty_details',function (Blueprint $table){
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
        Schema::dropIfExists('warranty_details');
    }
}
