<?php

use Illuminate\Database\Seeder;
use App\StatusService;

class StatusServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getStatusServiceData();
        foreach($data as $key => $value){
            StatusService::create($value);
        }
    }
    private function getStatusServiceData(){
        return [
            [
                'Status_name' => 'Trong bảo hành'
            ],
            [
                'Status_name' => 'Trong bảo trì'
            ],
            [
                'Status_name' => 'Hết hạn bảo hành - bảo trì'
            ],
            [
                'Status_name' => 'Máy sửa chữa bên ngoài'
            ]
        ];
    }
}
