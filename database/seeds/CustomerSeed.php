<?php

use Illuminate\Database\Seeder;

class CustomerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
        	[
        		'customer_id'=>'1',
        		'customer_name'=>'thanh',
        		'customer_email'=>'thanh@gmail.com',
        		'customer_address'=>'lien trung',
        		'customer_phone'=>'0967461697',
        		'customer_contact'=>'Lientrung',
        	],
        	[
        		'customer_id'=>'2',
        		'customer_name'=>'thanh1',
        		'customer_email'=>'thanh1@gmail.com',
        		'customer_address'=>'lien trung',
        		'customer_phone'=>'0967461693',
        		'customer_contact'=>'Lientrung',
        	],
        	[
        		'customer_id'=>'3',
        		'customer_name'=>'thanh2',
        		'customer_email'=>'thanh2@gmail.com',
        		'customer_address'=>'lien trung',
        		'customer_phone'=>'0967461694',
        		'customer_contact'=>'Lientrung',
        	],
        	[
        		'customer_id'=>'4',
        		'customer_name'=>'thanh3',
        		'customer_email'=>'thanh3@gmail.com',
        		'customer_address'=>'lien trung',
        		'customer_phone'=>'0967461695',
        		'customer_contact'=>'Lientrung',
        	],
        ]);
    }
}
