<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(CategorySeed::class);
//         $this->call(CustomerSeed::class);
//         $this->call(ProductSeed::class);
         $this->call(StatusServiceSeeder::class);
         $this->call(CompanySeeder::class);
         $this->call(UserSeeder::class);
         $this->call(StatusAfterServicesSeeder::class);
    }
}
