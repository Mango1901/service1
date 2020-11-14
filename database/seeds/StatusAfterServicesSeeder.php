<?php

use Illuminate\Database\Seeder;
use App\StatusAfterServices;
class StatusAfterServicesSeeder extends Seeder
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
            StatusAfterServices::create($value);
        }
    }
    private function getStatusServiceData(){
        return [
            [
                'status_services_name' => 'Hoàn thành/Complete'
            ],
            [
                'status_services_name' => 'Chưa hoàn thành/Incomplete'
            ],
            [
                'status_services_name' => 'Chờ thay thế link kiện/Pending for spares'
            ],
            [
                'status_services_name' => 'Theo dỗi thêm/Under Observation'
            ]
        ];
    }
}
