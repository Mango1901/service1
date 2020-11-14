<?php

namespace App\Http\Controllers;
use App\Service;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SentMailController extends Controller
{
    public function send_mail_update_services($services_id)
    {
        $services = Service::where('services_id',$services_id)
            ->join('users','users.id','=','services.installation_engineer_id')
            ->join('customers','customers.customer_id','=','services.customer_id')
            ->first();
        $to_name ="Từ Hải Hiếu";
        $to_email="deaglelinhtrinh@gmail.com"; //email cho admin (specific)
        $data = array("name"=>$services->name,"body"=>"Sửa ở services");

        Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Forgot password?');
            $message->from($to_email,$to_name);
        });

        $to_name ="Từ Hải Hiếu";
        $to_email=$services->customer_email;// email do admin lập nên
        $data = array("name"=>$services->name,"body"=>"Sửa ở services");

        Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Sửa thông tin ở services?');
            $message->from($to_email,$to_name);
        });
        return Redirect::to('/Add-service-update/'.$services_id)->with('message','Update services successfully');
    }
    public function send_mail_update_warranty($warranty_id)
    {
        $to_name ="Từ Hải Hiếu";
        $to_email="deaglelinhtrinh@gmail.com";
        $data = array("name"=>"Mail From Customer","body"=>"FeedBack");

        Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Forgot password?');
            $message->from($to_email,$to_name);
        });
        return Redirect::to('/')->with('message','');
    }
}
