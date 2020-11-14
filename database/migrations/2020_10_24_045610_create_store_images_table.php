<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_images', function (Blueprint $table) {
            $table->Increments('store_image_id');
            $table->Integer('services_id')->unsigned();
            $table->String('store_image_file');
            $table->Integer('company_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('store_images',function (Blueprint $table){
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
        Schema::dropIfExists('store_images');
    }
}
