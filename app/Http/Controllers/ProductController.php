<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
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
    public function add_product()
    {
//        $this->Auth_login();
        $category = Category::orderby('category_id','DESC')->where('company_id',Session::get('company_id'))->where('Action','0')->get();
        return view('product.add_product')->with('category',$category);
    }
    public function show_product()
    {
//        $this->Auth_login();
        $show_product = Product::orderby('product_id','DESC')->where('Action','0')->first();
        if(Session::get('roles') === 'root'){
            $product= Product::orderby('product_id','DESC')->where('Action','0')->paginate(10);
        }else{
            $product= Product::orderby('product_id','DESC')->where('Action','0')->where('company_id',Session::get('company_id'))->paginate(10);
        }

        return view('product.product_list',compact('show_product'))->with('product',$product);
    }
    public function product_save(Request $request)
    {
//        $this->Auth_login();
        $data = $request->all();
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_name'];
        $product->product_model = $data['product_model'];
        $product->product_serial = $data['product_serial'];
        $product->product_notes = $data['product_notes'];
        $product->company_id = Session::get('company_id');
        $product->user_id = Session::get('id');

        $check_product_model = Product::where('product_model',$data['product_model'])->where('company_id',Session::get('company_id'))->first();
        if($check_product_model){
            return redirect()->back()->with('error','This model had been already in use! Please try others');
        }
        $check_serial = Product::where('product_serial',$data['product_serial'])->where('company_id',Session::get('company_id'))->first();
            if($check_serial){
                return redirect()->back()->with('message','Serial code này đã tồn tại vui lòng nhập mã khác');
            }
        $get_image =$request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,1000).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('CongtyTamViet/uploads/',$new_image);
            $product->product_image =  $new_image;
            $product->save();
            return redirect()->back()->with('message','Thêm sản phẩm thành công');
        } else {
            $product->product_image = '';
            $product->save();
            return redirect()->back()->with('message','Thêm sản phẩm thành công');
        }
    }
    public function update_product($product_id)
    {
//        $this->Auth_login();
        $product = Product::find($product_id);
        $update_product = Product::where('product_id',$product_id)->where('Action','0')->get();
        $update_product_1 = Product::where('product_id',$product_id)->first();
        $category = Category::orderby('category_id','DESC')
            ->where('company_id',Session::get('company_id'))
            ->whereNotIn('category_id',[$update_product_1->category_id])->where('categories.Action','0')->get();
        if(Auth::user()->can('update',$product)){
        return view('product.update_product')->with('update_product',$update_product)->with('category',$category);
        }else{
            abort(403);
        }
    }
    public function update_product_save(Request $request,$product_id)
    {
//        $this->Auth_login();
        $data = $request->all();
        $update_product = Product::where('product_id',$product_id)->first();
        $update_product->category_id = $data['category_name'];
        $update_product->product_name = $data['product_name'];
        $update_product->product_model = $data['product_model'];
        $update_product->product_serial = $data['product_serial'];
        $update_product->product_notes = $data['product_notes'];

        if(Gate::allows('is-root')){
            $check_product_model = Product::where('product_model',$data['product_model'])->whereNotIn('product_id',[$product_id])->first();
            $check_serial = Product::where('product_serial',$data['product_serial'])->whereNotIn('product_id',[$product_id])->first();
        }else{
            $check_product_model = Product::where('product_model',$data['product_model'])->whereNotIn('product_id',[$product_id])->where('company_id',Session::get('company_id'))->first();
            $check_serial = Product::where('product_serial',$data['product_serial'])->whereNotIn('product_id',[$product_id])->where('company_id',Session::get('company_id'))->first();
        }
        if($check_product_model){
            return redirect()->back()->with('error','Model này đã được sử dụng! Hãy thử các mã khác');
        }
        if($check_serial){
            return redirect()->back()->with('message','Serial code này đã tồn tại vui lòng nhập mã khác');
        }
        $get_image =$request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image ->move('CongtyTamViet/uploads/',$new_image);
            $update_product->product_image =  $new_image;
            $product = Product::find($product_id);
                $update_product->save();
                return redirect()->back()->with('message', 'Thay đổi thông tin về sản phẩm thành công ');
        } else {
                $update_product->save();
                return redirect()->back()->with('message', 'Thay đổi thông tin về sản phẩm thành công ');
            }
    }
    public function delete_product($product_id)
    {
        $product = Product::find($product_id);
        if (Auth()->user()->can('delete', $product)){
        Product::where('product_id',$product_id)->update(['Action'=>'1']);
        return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            abort(403);
        }
    }
    public function print_product_serial(Request $request)
    {
        $data = $request->all();
        if($data['action'] == 'Product'){
            $print_serial = Product::where('product_id',$data['product_id'])->first();
            echo '<input type="text" id="Serial" name="Serial" readonly value="' .$print_serial->product_serial . '"/>';
        }
    }
}
