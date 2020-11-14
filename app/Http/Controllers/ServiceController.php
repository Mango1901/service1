<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\StatusService;
use App\User;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WarrantyExport;
use Illuminate\Support\Facades\Auth;
use PDF;

class ServiceController extends Controller
{
//    public function Auth_login()
//    {
//        $admin_id = session::get('id');
//        $company_id = session::get('company_id');
//        if($admin_id && $company_id){
//            return redirect()->route('/');
//        } else {
//            return redirect()->route('login')->send();
//        }
//    }
    public function index()
    {
//        $this->Auth_login();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        return view('layout')->with('status_services',$status_services);
    }
    public function home()
    {
//        $this->Auth_login();
        if(Session::get('roles') !== 'root'){
            $service_home = Service::orderby('services_id','DESC')->where('Action','0')->where('company_id',Session::get('company_id'))->paginate(10);
        }else{
            $service_home = Service::orderby('services_id','DESC')->where('Action','0')->paginate(10);
        }
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        return view('service.Home')->with('service_home',$service_home)->with('status_services',$status_services);
    }
    public function show_search(Request $request)
    {
//        $this->Auth_login();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        $service = Service::orderby('services_id','DESC')->where('Action','0')->first();
        $keywords = Session::get('keywords');
        if(Session::get('roles') === 'root'){
            $show_search = Service::orderby('services_id','DESC')->join('products','products.product_id','services.product_id')
                ->where('services.Action','0')->where('product_serial','like','%'.$keywords.'%')
                ->orwhere('product_name','like','%'.$keywords.'%')
                ->orwhere('product_model','like','%'.$keywords.'%')
                ->paginate(10);
        }else {
            $show_search = Service::orderby('services_id','DESC')->join('products','products.product_id','services.product_id')
                ->where('services.Action','0')->where('product_serial','like','%'.$keywords.'%')
                ->orwhere('product_name','like','%'.$keywords.'%')
                ->orwhere('product_model','like','%'.$keywords.'%')
                ->where('services.company_id',Session::get('company_id'))
                ->paginate(10);
        }

        return view('service.search',compact('service'))->with('show_search',$show_search)->with('status_services',$status_services);
    }
    public function searchItem(Request $request)
    {
//        $this->Auth_login();
        $keywords = $request->search_submit;
        Session::put('keywords',$keywords);
        return Redirect::to('/search');
    }
    public function get_items(Request $request)
    {
//        $this->Auth_login();
        $status_value_1 = $request->status_value_1;
        $status_value_2 = $request->status_value_2;
        $status_value_3 = $request->status_value_3;
        $status_value_4 = $request->status_value_4;

        Session::put('status_value_1',$status_value_1);
        Session::put('status_value_2',$status_value_2);
        Session::put('status_value_3',$status_value_3);
        Session::put('status_value_4',$status_value_4);

        return Redirect::to('/items');
    }
    public function show_items(Request $request)
    {
//        $this->Auth_login();
        $bao_hanh = Session::get('status_value_1'); //1
        $bao_tri = Session::get('status_value_2'); //2
        $het_han = Session::get('status_value_3'); //3
        $sua_ben_ngoai = Session::get('status_value_4'); //4
        $service = Service::orderby('services_id','DESC')->where('Action','0')->first();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        if(Session::get('roles') !== 'root'){
            $service_details = Service::orderby('services_id','DESC')->where('Action','0')->where('Status',$bao_hanh)->orwhere('Status',$bao_tri)
            ->orwhere('Status',$het_han)->orwhere('Status',$sua_ben_ngoai)->where('company_id',Session::get('company_id'))->paginate(10);
        }else {
            $service_details = Service::orderby('services_id','DESC')->where('Action','0')->where('Status',$bao_hanh)->orwhere('Status',$bao_tri)
                ->orwhere('Status',$het_han)->orwhere('Status',$sua_ben_ngoai)->paginate(10);
        }
       return view('service.details',compact('service_details'))->with('service',$service)->with('status_services',$status_services);
    }
    public function add_service()
    {
//        $this->Auth_login();
        if(Session::get('roles') === 'root'){
        $service = Service::orderby('services_id','DESC')->get();
        $customer = Customer::orderby('customer_id','DESC')->get();
        $product = Product::orderby('product_id','DESC')->get();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        $user = User::orderby('id','DESC')->where('Action','0')->whereNotIn('users.roles',['admin','root'])->get();
        }else{
            $service = Service::orderby('services_id','DESC')->where('company_id',Session::get('company_id'))->get();
            $customer = Customer::orderby('customer_id','DESC')->where('company_id',Session::get('company_id'))->get();
            $product = Product::orderby('product_id','DESC')->where('company_id',Session::get('company_id'))->get();
            $status_services = StatusService::orderby('Status_id','DESC')->get();
            $user = User::orderby('id','DESC')->where('Action','0')->where('users.company_id',Session::get('company_id'))->whereNotIn('users.roles',['admin'])->get();
        }
        return view('service.add_service',compact('service'))->with('user',$user)->with('status_services',$status_services)->with('customer',$customer)->with('product',$product);
    }
    public function add_service_save(Request $request)
    {
//        $this->Auth_login();

        $data = $request->all();
        $service = new Service();
        $service->product_id = $data['product_id'];
        $service->Status = $data['Status'];
        $service->start_date = $data['start_date'];
        $service->end_date = $data['end_date'] ;
        $service->installation_engineer_id = $data['installation_engineer'];
        $service->customer_id = $data['customer_id'];
        $service->user_id = Auth::id();
        $service->company_id = Session::get('company_id');
        if($data['start_date'] > $data['end_date']){
            return redirect()->back()->with('error','Ngày kết thúc không thể nhỏ hơn ngày bắt đầu');
        }
        $service->save();

        return redirect()->back()->with('message','Thêm dịch vụ thành công');
    }
    public function add_service_update($id)
    {
//        $this->Auth_login();
        $services = Service::find($id);
        if (Auth()->user()->can('update', $services)) {
            $status_services = StatusService::orderby('Status_id','DESC')->get();
            $update_service1 = Service::where('services_id',$id)->where('Action','0')->first();
            $installation_id = $update_service1->installation_engineer_id;
            $update_service = Service::where('services_id',$id)->where('services.Action','0')
                ->join('users','users.id','=','services.installation_engineer_id')->whereNotIn('users.roles',['admin'])->get();
            $product = Product::orderby('product_id','DESC')->where('company_id',Session::get('company_id'))->where('Action',0)->whereNotIn('product_id',[$update_service1->product_id])->get();
            $check_service_status = Service::where('services_id',$id)->first();
            $Status_id = $check_service_status->Status;
            $Status_service_list = StatusService::orderby('Status_id','DESC')->whereNotIn('Status_id',[$Status_id])->get();
            $user = User::orderby('id','DESC')->where('company_id',Session::get('company_id'))
                ->whereNotIn('id',[$installation_id])->where('Action','0')->whereNotIn('roles',['admin'])->get();
            $customer = Customer::orderby('customer_id','DESC')
                ->where('company_id',Session::get('company_id'))->whereNotIn('customer_id',[$update_service1->customer_id])->get();
            return view('service.update_service')->with('update_service',$update_service)->with('user',$user)
                ->with('status_services',$status_services)->with('Status_service_list',$Status_service_list)->with('customer',$customer)->with('product',$product);
        }else{
            abort(403);
        }
    }
    public function add_service_update_save(Request $request,$id)
    {
//        $this->Auth_login();
        $service = Service::where('services_id',$id)->where('Action','0')->first();

        $data = $request->all();
        $service->product_id = $data['product_id'];
        $service->start_date = $data['start_date'];
        $service->end_date = $data['end_date'];
        $service->Status = $data['Status'];
        $service->installation_engineer_id = $data['installation_engineer'];
        $service->Customer->customer_id = $data['customer_id'];
        if($data['start_date'] > $data['end_date']){
            return redirect()->back()->with('error','Ngày kết thúc không thể nhỏ hơn ngày bắt đầu');
        }
        $service->save();

            $to_name = Session::get('name');
            $to_email = Session::get('email');// email do admin lập nên
            $data = array("name" => $service->name, "body" => "Sửa ở services");
            Mail::send('email.send_mail', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)->subject('Sửa thông tin dịch vụ');
                $message->from($to_email, $to_name);
            });

        return redirect()->back()->with('message','Thay đổi dịch vụ thành công ! xin hãy kiểm tra lại email');
    }
    public function delete_service($id)
    {
//        $this->Auth_login();
        $services = Service::where('services_id',$id)->first();
        if (Auth()->user()->can('delete', $services)) {
            Service::where('services_id', $id)->update(['Action' => '1']);
            return redirect()->back()->with('message', 'Xóa dịch vụ thành công');
        } else {
            abort(403);
        }
    }
    public function export()
    {
        $time = Carbon::now();
        $nameFile = "Service"."_".$time;
        return Excel::download(new WarrantyExport,$nameFile.'.xlsx');
    }
    public function exportService()
    {

        $service = Service::orderby('services_id','DESC')
            ->where('services.company_id',Session::get('company_id'))
            ->join('products','products.product_id','=','services.product_id')->get();
        $time = Carbon::now()->format('d/m/Y');
        $pdf = PDF::loadView('service/exportPDF',compact('service'));
        return $pdf->stream('Export_Service_'.$time.'.pdf');
    }
    public function searchByName(Request $request)
    {
        $keyword = $request->input('keyword');
        $product = Product::select('product_name')
            ->where('company_id',Session::get('company_id'))
            ->where('product_name', 'LIKE', "%$keyword%")->get();
        return response()->json($product);
    }
}
