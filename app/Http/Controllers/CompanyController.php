<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
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
    public function register_company_admin()
    {
        return view('user.admin_user');
    }
    public function save_register_company_admin(Request $request)
    {
        $data = $request->all();
        $company = new Company();
        $company->company_name = $data['company_name'];

        $check_company_exist = Company::orderby('company_id','DESC')->first();
        $check_company = Company::where('company_name',$data['company_name'])->first();
        if($check_company_exist){
            if(isset($check_company)){
                return redirect()->back()->with('message','This company name had already been used');
            }
        }
        $company->save();

        $getCompanyId = Company::where('company_name',$data['company_name'])->first();

        $check_user_exist = User::orderby('id','DESC')->first();
        $user_check_email = User::where('email',$data['email'])->where('company_id',Session::get('company_id'))->first();
        $user_check_name =  User::where('name',$data['name'])->where('company_id',Session::get('company_id'))->first();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->roles = 'admin';
        $user->company_id = $getCompanyId->company_id;

        if(isset($check_user_exist->email)){
            if($user_check_email){
                return redirect()->back()->with('error','Email này đã tồn tại !Hãy sử dụng cái khác');
            }
        }
        if(isset($check_user_exist->name)){
            if($user_check_name){
                return redirect()->back()->with('error','Tên này đã tồn tại!Hãy sử dụng cái khác');
            }
        }
        $user->save();
        return redirect()->back()->with('message','Add user admin successfully');
    }
    public function company_admin()
    {
//        $this->Auth_login();
        if(Gate::allows('is-root')){
            $user = User::orderby('id','DESC')->where('Action',0)->paginate(10);
            return view('user.show_admin_user')->with('user',$user);
        }else{
            abort(403);
        }
    }
}
