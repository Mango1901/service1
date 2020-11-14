<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getUserData();
        foreach($data as $key => $value){
            User::create($value);
        }
    }
    private function getUserData(){
        return [
            [
                'name' => 'admin',
                'email'=> 'congtyphuongdong@gmail.com',
                'password'=> bcrypt('congtyphuongdong'),
                'roles' => 'root',
                'company_id'=>'1'
            ],

        ];
    }
}
