<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_services', function (Blueprint $table) {
            $table->Increments('Status_id');
            $table->String('Status_name');
            $table->timestamps();
        });
        Schema::table('services',function (Blueprint $table){
            $table->foreign('Status')->references('Status_id')->on('status_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_services');
    }
}
