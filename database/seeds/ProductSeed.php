<?php

use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	[
        		'product_id'=>'1',
        		'category_id'=>'1',
        		'product_name'=>'thuốc lào',
                'product_model'=>'1',
        		'product_serial'=>'XMS234',
        		'product_image'=>'image',
        		'product_notes'=>'NO',
        	],
        	[
        		'product_id'=>'2',
        		'category_id'=>'2',
        		'product_name'=>'thuốc ngựa',
        		'product_model'=>'2',
                'product_serial'=>'XMS41234',
        		'product_image'=>'image',
        		'product_notes'=>'NO',
        	],
        	[
        		'product_id'=>'3',
        		'category_id'=>'3',
        		'product_name'=>'thuốc malpro',
        		'product_model'=>'3',
                'product_serial'=>'XMS2342',
        		'product_image'=>'image',
        		'product_notes'=>'NO',
        	],
        	[
        		'product_id'=>'4',
        		'category_id'=>'4',
        		'product_name'=>'thuốc live',
        		'product_model'=>'4',
                'product_serial'=>'XMS3234',
        		'product_image'=>'image',
        		'product_notes'=>'NO',
        	],
        ]);
    }
}
