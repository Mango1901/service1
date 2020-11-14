<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
    public function show_register()
    {
//        $this->Auth_login();
        if(Gate::allows('is-admin')) {
            return view('user.register');
        }else{
            abort(403);
        }
    }
    public function show_user()
    {
//        $this->Auth_login();
        if(Gate::allows('is-admin')){
            $user = User::orderby('id','DESC')->whereNotIn('roles',['admin','root'])->where('company_id',Session::get('company_id'))->where('Action','0')->paginate(10);
            return view('user.show_user')->with('user',$user);
        }else{
            abort(403);
        }
    }
    public function add_user_update($id)
    {
//        $this->Auth_login();
        if(Gate::allows('is-admin')){
        $user = User::where('id',$id)->whereNotIn('users.roles',['admin'])->where('company_id',Session::get('company_id'))->get();
        return view('user.update_user')->with('user',$user);
        }else{
            abort(403);
        }
    }
    public function add_user_update_save(Request $request,$id)
    {
//        $this->Auth_login();
        $data = $request->all();
        $user_check_email = User::where('email',$data['email'])->whereNotIn('id',[$id])->first();
        $user_check_name =  User::where('name',$data['name'])->whereNotIn('id',[$id])->where('company_id',Session::get('company_id'))->first();

        $user_update = User::where('id',$id)->where('Action','0')->first();
        $user_update->name = $data['name'];
        $user_update->email = $data['email'];
        if($user_check_email){
            return redirect()->back()->with('error','Email này đã tồn tại !Hãy sử dụng cái khác');
        }
        if($user_check_name){
            return redirect()->back()->with('error','Tên này đã tồn tại!Hãy sử dụng cái khác');
        }
        if(Gate::allows('is-admin')){
        $user_update->save();
        return redirect()->back()->with('message','Thông tin đã được thay đổi');
        }else{
            abort(403);
        }
    }
    public function delete_user($id)
    {
        if(Gate::allows('is-admin')) {
//            $this->Auth_login();
            User::where('id', $id)->where('company_id',Session::get('company_id'))->update(['Action' => '1']);
            return redirect()->back()->with('message', 'Xóa kĩ sư thành công');
        } else {
            abort(403);
        }
    }
    public function show_login()
    {
        return view('user.login');
    }
    public function save_register(Request $request)
    {
//        $this->Auth_login();
            $data = $request->all();
            $user = User::orderby('id','DESC')->first();

            $user_check_email = User::where('email',$data['email'])->first();
                if(isset($user->email)){
                    if($user_check_email){
                        return redirect()->back()->with('error','Email này đã tồn tại !Hãy sử dụng cái khác');
                    }
                }
            $register = new User();

            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->company_id = Session::get('company_id');
            if($data['password'] === $data['confirm_password']){
                $register->password = bcrypt($data['password']);
                $register->save();
                return redirect()->back()->with('message', 'Đăng ký thành công');
            } else {
                return redirect()->back()->with('error','Mật khẩu và kiểm tra mật khẩu không khớp');
            }
    }
    public function login(Request $request)
    {
        $data = $request->all();
        $email = $data['email'];
        $password = ($request->password);
            if(Auth::attempt(['email'=> $email,'password'=> $password])){
                if(Auth::user()->Action == 1){
                    return redirect()->back()->with('error','email hoặc mật khẩu không đúng');
                }
                $id = Auth::id();
                Session::put('id',$id);
                Session::put('roles',Auth::user()->roles);
                Session::put('email',Auth::user()->email);
                Session::put('company_id',Auth::user()->company_id);
                return Redirect::to('/');
            } else {
                return redirect()->back()->with('error','email hoặc mật khẩu không đúng');
            }
    }
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }
    public function add_user_update_password($id)
    {
//        $this->Auth_login();
        $user = User::where('id',$id)->where('company_id',Session::get('company_id'))->get();
        return view('user.update_user_password')->with(compact('user'));
    }
    private function passwordCorrect($suppliedPassword)
    {
        return Hash::check($suppliedPassword, Auth::user()->password, []);
    }
    public function add_user_update_password_save(Request $request,$id)
    {
//        $this->Auth_login();
        $data = $request->all();
        $email = $data['email'];
        $password = ($data['password']);
            if($this->passwordCorrect($password) == false){
                return redirect()->back()->with('error','mật khẩu không đúng');
            } else {
                $new_password = $data['new_password'];
                $confirm_password = $data['confirm_password'];
                if($new_password != $confirm_password){
                    return redirect()->back()->with('error','Mật khẩu mới và mật khẩu kiêm tra không khớp ');
                } else {
                    $new_password = bcrypt($data['new_password']);
                    User::where('id',$id)->where('company_id',Session::get('company_id'))->update(['password'=>$new_password]);
                    return redirect()->back()->with('message','Thay đổi mật khẩu thành công');
                }
            }
    }
}
