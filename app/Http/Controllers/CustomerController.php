<?php

namespace App\Http\Controllers;

use App\StatusService;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
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
    public function show_add_customer()
    {
//        $this->Auth_login();
        return view('Customer.add_customer');
    }
    public function show_add_customer_popup()
    {
//        $this->Auth_login();
        return view('Customer.add_customer_popup');
    }
    public function add_customer_save(Request $request)
    {
//        $this->Auth_login();
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_contact = $data['customer_contact'];
        $customer->company_id = Session::get('company_id');
        $customer->user_id = Session::get('id');

        $check_customer_email_exist = Customer::where('customer_email',$data['customer_email'])->where('company_id',Session::get('company_id'))->first();
        $check_customer_phone_exist = Customer::where('customer_phone',$data['customer_phone'])->where('company_id',Session::get('company_id'))->first();

        if($check_customer_email_exist){
            return redirect()->back()->with('error','Email này đã được sử dụng! Hãy thử cái khác!');
        }
        if($check_customer_phone_exist){
            return redirect()->back()->with('error','Số điện thoại này đã được sử dụng! Hãy thử cái khác!');
        }
        $customer->save();
        return redirect()->back()->with('message','Thêm khách hàng thành công');
    }
    public function show_customer()
    {
//        $this->Auth_login();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        if(Session::get('roles') === 'root'){
            $customer = Customer::orderBy('customer_id','DESC')->where('Action',0)->paginate(10);
        }else{
            $customer = Customer::orderBy('customer_id','DESC')->where('Action',0)->where('company_id',Session::get('company_id'))->paginate(10);
        }
        return view('Customer.customer_details')->with('customer',$customer)->with('status_services',$status_services);
    }
    public function update_customer($customer_id)
    {
//        $this->Auth_login();
        $customer = Customer::find($customer_id);
        if(Auth::user()->can('update',$customer)){
        $update_customer = Customer::where('customer_id',$customer_id)->where('company_id',Session::get('company_id'))->where('Action',0)->get();
        return view('Customer.update_customer')->with('update_customer',$update_customer);
        }else{
            abort(403);
        }
    }
    public function update_customer_save(Request $request,$customer_id)
    {
//        $this->Auth_login();
        $data = $request->all();
        $update_customer = Customer::where('customer_id',$customer_id)->where('Action',0)->first();
        $update_customer->customer_name = $data['customer_name'];
        $update_customer->customer_email = $data['customer_email'];
        $update_customer->customer_address = $data['customer_address'];
        $update_customer->customer_phone = $data['customer_phone'];
        $update_customer->customer_contact = $data['customer_contact'];

        $check_customer_email_exist = Customer::where('customer_email',$data['customer_email'])->whereNotIn('customer_id',[$customer_id])->where('company_id',Session::get('company_id'))->first();
        $check_customer_phone_exist = Customer::where('customer_phone',$data['customer_phone'])->whereNotIn('customer_id',[$customer_id])->where('company_id',Session::get('company_id'))->first();

        if($check_customer_email_exist){
            return redirect()->back()->with('error','Email này đã được sử dụng! Hãy thử cái khác!');
        }
        if($check_customer_phone_exist){
            return redirect()->back()->with('error','Số điện thoại này đã được sử dụng! Hãy thử cái khác!');
        }

        $update_customer->save();
        return redirect()->back()->with('message','Thay đổi thông tin khách hàng thành công');
    }
    public function delete_customer($customer_id)
    {
//        $this->Auth_login();
        $customer = Customer::find($customer_id);
        if(Auth::user()->can('delete',$customer)){
        Customer::where('customer_id',$customer_id)->where('company_id',Session::get('company_id'))->update(['Action'=>'1']);
        return redirect()->back()->with('message','Xóa thông tin về khách hàng thành công');
        }else{
            abort(403);
        }
    }
    public function print_customer_address(Request $request)
    {
        $data = $request->all();
        if($data['action'] == 'Name'){
            $print_address = Customer::where('customer_id',$data['customer_id'])->first();
            echo '<input type="text" name="Address" readonly value="' .$print_address->customer_address . '"/>';
        }
    }
}
