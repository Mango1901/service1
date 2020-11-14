<?php

use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	[
        		'category_id'=>'1',
        		'category_name'=>'No',
        	],
        	[
        		'category_id'=>'2',
        		'category_name'=>'No2',
        	],
        	[
        		'category_id'=>'3',
        		'category_name'=>'No3',
        	],
        	[
        		'category_id'=>'4',
        		'category_name'=>'No4',
        	],
        	[
        		'category_id'=>'5',
        		'category_name'=>'No5',
        	],
        ]);
    }
}
