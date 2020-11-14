<?php

namespace App\Http\Controllers;

use App\Service;
use App\Customer;
use App\Product;
use App\StatusAfterServices;
use App\StatusService;
use App\User;
use Illuminate\Http\Request;
use App\warrantyDetails;
use Illuminate\Session\Store;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\StoreImage;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\Auth;


class WarrantyController extends Controller
{
    public function Auth_login()
    {
        $admin_id = session::get('id');
        $company_id = session::get('company_id');
        if($admin_id && $company_id){
            return redirect()->route('/');
        } else {
            return redirect()->route('login')->send();
        }
    }
    public function warranty_show_details($services_id)
    {
//        $this->Auth_login();
        $service = Service::where('services_id',$services_id)->first();
       if(Auth::user()->can('update',$service)){
        $warranty_status = StatusAfterServices::orderby('status_services_id','DESC')->get();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        $user = User::orderby('id','DESC')->where('Action','0')->where('company_id',Session::get('company_id'))->whereNotIn('roles',['admin'])->get();
        $service = Service::where('services_id',$services_id)->get();
        return view('warranty.warranty')->with('service',$service)->with('user',$user)->with('status_services',$status_services)->with('warranty_status',$warranty_status);
       }else{
           abort(403);
       }
    }
    public function warranty_save_details(Request $request,$services_id)
    {
//        $this->Auth_login();
        $carbon = Carbon::now();
        $data = $request->all();
        Session::put('services_id',$services_id);

        $warranty_details = new warrantyDetails();
        $warranty_details->services_id= $services_id;
        $warranty_details->warranty_date = $carbon->toDateString();
        $warranty_details->warranty_hour = $data['warranty_hour'];
        $warranty_details->warranty_hour2 = $data['warranty_hour2'];
        $warranty_details->maintenance_engineer_id = $data['maintenance_engineer'];
        $warranty_details->replacement_components = $data['replacement_components'];
        $warranty_details->results = $data['results'];
        $warranty_details->job_details = $data['job_details'];
        $warranty_details->survey_results = $data['survey_results'];
        $warranty_details->company_id = Session::get('company_id');

        $warranty_details->warranty_status_error = $data['Status_error'];
        $warranty_details->warranty_cause = $data['warranty_cause'];
        $warranty_details->warranty_solution = $data['warranty_solution'];
        $warranty_details->warranty_notes = $data['warranty_notes'];
        $warranty_details->warranty_status = $data['warranty_status'];
        $warranty_details->user_id = Auth::id();

        if($data['warranty_hour']>$data['warranty_hour2']){
            return redirect()->back()->with('error','Giờ đến bé hơn giờ về');
        }
        $warranty_details->save();
        return redirect()->back()->with('message','Thêm lịch sử bảo hành thành công ');
    }
    public function warranty_details($services_id)
    {
        $id = $services_id;
//        $this->Auth_login();
        $service = Service::find($services_id);
        if(Auth::user()->can('view',$service)) {
            $store_image = StoreImage::orderby('store_image_id', 'DESC')->where('services_id', $services_id)->get();
            $status_services = StatusService::orderby('Status_id', 'DESC')->get();
            $service = Service::where('services_id', $services_id)
                ->join('users', 'users.id', '=', 'services.installation_engineer_id')
                ->join('customers', 'customers.customer_id', '=', 'services.customer_id')
                ->join('products', 'products.product_id', '=', 'services.product_id')
                ->whereNotIn('users.roles', ['admin'])->get();
            $warranty_details = warrantyDetails::orderby('warranty_id', 'DESC')->where('warranty_details.services_id', $services_id)->
            join('services', 'services.services_id', '=', 'warranty_details.services_id')->join('users', 'users.id', '=', 'warranty_details.maintenance_engineer_id')
                ->whereNotIn('users.roles', ['admin'])->get();
            return view('warranty.warranty_details', compact('store_image', 'warranty_details', 'service', 'status_services', 'id'));
        }else{
            abort(403);
        }
    }
    public function warranty_show_details_update($services_id,$id)
    {
//        $this->Auth_login();
        $warranty_details = warrantyDetails::where('services_id',$services_id)->where('warranty_id',$id)->first();
        if(Auth()->user()->can('update', $warranty_details)){
            $status_services = StatusService::orderby('Status_id', 'DESC')->get();
            $warranty_update1 = warrantyDetails::where('services_id', $services_id)->first();
            $warranty_update = warrantyDetails::where('services_id', $services_id)
                ->join('users', 'users.id', '=', 'warranty_details.maintenance_engineer_id')
                ->where('warranty_id', $id)->where('users.Action','0')
                ->join('status_after_services', 'status_after_services.status_services_id', '=', 'warranty_details.warranty_status')
                ->whereNotIn('users.roles', ['admin'])->get();
            $warranty_status = StatusAfterServices::orderby('status_services_id', 'DESC')->whereNotIn('status_services_id', [$warranty_update1->warranty_status])->get();
            $maintenance_engineer_id = $warranty_update1->maintenance_engineer_id;
            $user = User::orderby('id', 'DESC')->where('company_id',Session::get('company_id'))->whereNotIn('id', [$maintenance_engineer_id])->where('Action', '0')->whereNotIn('users.roles', ['admin'])->get();
            return view('warranty.warranty_update_details')->with('warranty_status', $warranty_status)
                ->with('warranty_update', $warranty_update)->with('user', $user)->with('status_services', $status_services);
        }else{
            abort(403);
        }
    }
    public function warranty_save_details_update(Request $request,$services_id,$id)
    {
//        $this->Auth_login();
        $data = $request->all();
        $warranty_details = warrantyDetails::where('services_id',$services_id)->where('warranty_id',$id)
            ->join('users','users.id','=','warranty_details.maintenance_engineer_id')
            ->first();

        $warranty_details->warranty_date = $data['warranty_date'];
        $warranty_details->warranty_hour = $data['warranty_hour'];
        $warranty_details->warranty_hour2 = $data['warranty_hour2'];
        $warranty_details->maintenance_engineer_id = $data['maintenance_engineer'];
        $warranty_details->results = $data['results'];
        $warranty_details->job_details = $data['job_details'];
        $warranty_details->survey_results = $data['survey_results'];
        $warranty_details->replacement_components = $data['replacement_components'];
        $warranty_details->warranty_status_error = $data['Status_error'];
        $warranty_details->warranty_cause = $data['warranty_cause'];
        $warranty_details->warranty_solution = $data['warranty_solution'];
        $warranty_details->warranty_notes = $data['warranty_notes'];
        $warranty_details->warranty_status = $data['warranty_status'];
        $warranty_details->save();

        $to_name =  'Từ Hải Hiếu';
        $to_email="deaglelinhtrinh@gmail.com"; //email cho admin (specific)
        $data_mail = array("name"=>Session::get('name'),"body"=>"Sửa ở warranty");

        Mail::send('email.send_mail',$data_mail,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Thay đổi lịch sử bảo hành ');
            $message->from($to_email,$to_name);
        });

        $to_name =Session::get('name');
        $to_email=Session::get('email');// email do admin lập nên
        $data = array("name"=>Session::get('name'),"body"=>"Sửa ở warranty");

        Mail::send('email.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Thay đổi lịch sử bảo hành');
            $message->from($to_email,$to_name);
        });
        return redirect()->back()->with('message','Thay đổi lịch sử bảo hành thành công!Hãy kiểm tra email');
    }

    public function exportWarranty($services_id,$id)
    {
//        $this->Auth_login();
        $customer = Customer::join('services','services.customer_id','=','customers.customer_id')
            ->where('customers.company_id',Session::get('company_id'))
            ->where('services.services_id',$services_id)->get();
        $warrantyDetails = warrantyDetails::where('services.services_id',$services_id)
            ->join('services','services.services_id','=','warranty_details.services_id')
            ->where('warranty_details.company_id',Session::get('company_id'))
            ->where('warranty_id',$id)->get();
        $product = Product::where('services.services_id',$services_id)
            ->where('products.company_id',Session::get('company_id'))
            ->join('services','services.product_id','=','products.product_id')->get();
        $service = Service::where('services.services_id',$services_id)->where('company_id',Session::get('company_id'))->get();
        $pdf = PDF::loadView('warranty/exportPDF',compact('warrantyDetails','customer','service','product'));
        return $pdf->stream('exportPDF.pdf');
    }
    public function exportWarrantyVersion2($services_id,$id)
    {
//        $this->Auth_login();
        $customer = Customer::join('services','services.customer_id','=','customers.customer_id')
            ->where('customers.company_id',Session::get('company_id'))
            ->where('services.services_id',$services_id)->get();
        $warrantyDetails = warrantyDetails::where('services.services_id',$services_id)->join('services','services.services_id','=','warranty_details.services_id')
            ->where('warranty_details.company_id',Session::get('company_id'))
            ->where('warranty_id',$id)->get();
        $product = Product::where('services.services_id',$services_id)
            ->where('products.company_id',Session::get('company_id'))
            ->join('services','services.product_id','=','products.product_id')->get();
        $service = Service::where('services.services_id',$services_id)->where('company_id',Session::get('company_id'))->get();
        $pdf = PDF::loadView('warranty/exportPDF1',compact('warrantyDetails','customer','service','product'));
        return $pdf->stream('export_PDF_Version_2.pdf');
    }

}
