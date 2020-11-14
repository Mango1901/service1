<?php

namespace App\Http\Controllers;

use App\StatusService;
use App\User;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
    public function show_add_category()
    {
//        $this->Auth_login();
        $status_services = StatusService::orderby('Status_id','DESC')->get();
        return view('category.add_category')->with('status_services',$status_services);
    }
    public function show_category()
    {
//        $this->Auth_login();
        if(Session::get('roles') === 'root'){
            $category = Category::orderby('category_id','DESC')->where('Action','0')->paginate(10);
        }else{
            $category = Category::orderby('category_id','DESC')->where('Action','0')->where('company_id',Session::get('company_id'))->paginate(10);
        }
        return view('category.category_list')->with('category',$category);
    }
    public function category_save(Request $request)
    {
//        $this->Auth_login();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->company_id = Session::get('company_id');
        $category->user_id = Session::get('id');
        $check_category_name = Category::where('category_name',$data['category_name'])->where('company_id',Session::get('company_id'))->first();
        if($check_category_name){
            return redirect()->back()->with('error','Tên đã tồn tại');
        }
        $category->save();
        return redirect()->back()->with('message','Thêm loại sản phẩm thành công');
    }
    public function update_category($category_id)
    {
//        $this->Auth_login();
        $category = Category::find($category_id);
        if(Auth::user()->can('update',$category)){
        $update_category = Category::where('category_id',$category_id)->where('Action','0')->get();
        return view('category.update_category')->with('update_category',$update_category);
        }else{
            abort(403);
        }
    }
    public function update_category_save(Request $request,$category_id)
    {
//        $this->Auth_login();
        $data = $request->all();

        $update_category = Category::where('category_id',$category_id)->first();
        $update_category->category_name = $data['category_name'];
        $check_category_name = Category::where('category_name',$data['category_name'])->where('company_id',Session::get('company_id'))->whereNotIn('category_id',[$update_category->category_id])->first();
        if($check_category_name){
            return redirect()->back()->with('error','Tên đã tồn tại');
        }
        $update_category->save();

        return redirect()->back()->with('message','Thay đổi loại sản phẩm thành công');
    }
    public function delete_category($category_id)
    {
//        $this->Auth_login();
        $category = Category::find($category_id);
        if(Auth::user()->can('delete',$category)){
        Category::where('category_id',$category_id)->update(['Action'=>'1']);
        return redirect()->back()->with('message','Xóa loại sản phẩm thành công');
        }else{
            abort(403);
        }
    }
}
