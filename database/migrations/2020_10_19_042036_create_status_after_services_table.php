<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusAfterServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_after_services', function (Blueprint $table) {
            $table->Increments('status_services_id');
            $table->String('status_services_name');
            $table->timestamps();
        });
        Schema::table('warranty_details',function (Blueprint $table){
            $table->foreign('warranty_status')->references('status_services_id')->on('status_after_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_after_services');
    }
}
