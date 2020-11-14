<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('product_id');
            $table->Integer('category_id')->unsigned();
            $table->String('product_name',255);
            $table->String('product_model',80);
            $table->String('product_serial',80);
            $table->String('product_image');
            $table->Text(  'product_notes');
            $table->Integer('Action')->default(0);
            $table->Integer('company_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('products',function (Blueprint $table){
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
        Schema::table('products',function (Blueprint $table){
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
        Schema::dropIfExists('products');
    }
}
