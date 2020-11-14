<?php

use Illuminate\Database\Seeder;

class ServicesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
        	[
	        	'services_id'=>'1',
	        	'Status'=>'1',
	        	'start_date'=>'2020-10-19',
	        	'end_date'=>'2020-11-19 ',
	        	'customer_id'=>'1',
	        	'product_id'=>'1',
	        	'Action'=>'1',
	        	'installation_engineer_id'=>'2',
	        ],
	        [
	        	'services_id'=>'2',
	        	'Status'=>'2',
	        	'start_date'=>'2020-10-19',
	        	'end_date'=>'2020-11-19 ',
	        	'customer_id'=>'2',
	        	'Action'=>'1',
	        	'product_id'=>'2',
	        	'installation_engineer_id'=>'1',
	        ],
	        [
	        	'services_id'=>'3',
	        	'Status'=>'3',
	        	'start_date'=>'2020-10-19',
	        	'end_date'=>'2020-11-19 ',
	        	'customer_id'=>'3',
	        	'Action'=>'1',
	        	'product_id'=>'3',
	        	'installation_engineer_id'=>'2',
	        ],
	        [
	        	'services_id'=>'4',
	        	'Status'=>'4',
	        	'start_date'=>'2020-10-19',
	        	'end_date'=>'2020-11-19 ',
	        	'customer_id'=>'1',
	        	'Action'=>'1',
	        	'product_id'=>'1',
	        	'installation_engineer_id'=>'1',
	        ],
        ]);
    }
}
