<?php

namespace App\Console\Commands;

use App\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpirationDate:call';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Thông báo sản phẩm đã hết hạn bảo hành';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $carbon = Carbon::now();
        $current_date = $carbon->toDateString();
        $check_expiration_services = Service::whereDate('end_date','<',$current_date)->where('Status','1')->orwhere('Status','2')->first();
        $expiration_services = Service::whereDate('end_date','<',$current_date)->where('Status','1')->orwhere('Status','2')->get();
        if($check_expiration_services){
            foreach($expiration_services as $key => $value){
                $to_name ='admin';
                $to_email='deagleka1@gmail.com';// email do admin lập nên
                $data = array("name"=>$value->Product->product_name,"body"=>"sản phẩm trên đã hết hạn bảo hành");
                Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Thông báo dịch vụ bảo hành');
                    $message->from($to_email,$to_name);
                });
            }
         } else {
            $to_name ='admin';
            $to_email='deagleka1@gmail.com';// email do admin lập nên
            $data = array("name"=>'',"body"=>"Không có sản phẩm nào hết hạn bảo hành");
            Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
                $message->to($to_email)->subject('Thông báo dịch vụ bảo hành');
                $message->from($to_email,$to_name);
            });
        }
    }
}
