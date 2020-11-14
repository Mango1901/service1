<?php

namespace App\Exports;

use App\warrantyDetails;
use App\Service;
use App\Product;
use App\Customer;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;


class WarrantyExport implements FromCollection,WithMapping,WithHeadings
{
	use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Service::all();
    }

//    $sheet->setAutoSize(true);
     public function map($service): array
    {
        return [
            $service->Product->product_serial,
            $service->Product->product_model,
            $service->StatusService->Status_name,
            Carbon::parse($service->start_date )->format('d-m-Y'),
           	Carbon::parse($service->end_date )->format('d-m-Y'),
            $service->Customer->customer_name,
            $service->User->name,
        ];
    }
    //đặt tên cột
    public function headings(): array
    {
        return [
            'Số Serial',
            'Model',
            'Trạng thái',
            'Ngày lắp đặt',
            'Ngày hết hạn',
            'Kĩ sư lắp đặt',
            'Tên khách hàng',
        ];
    }
    // định dạng cột theo %
    // $sheet->setAutoSize(true);
    // $sheet->setColumnFormat(array(
    // 'A' => '10%',
    // 'B' => '10%',
    // 'C' => '10%',
    // 'D' => '10%',
    // 'E' => '10%',
    // 'F' => '10%',
    // 'G' => '10%',
}
