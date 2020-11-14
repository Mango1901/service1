<?php

namespace App\Http\Controllers;

use App\StoreImage;
use App\warrantyDetails;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class StoreImageController extends Controller
{
    public function Auth_login(){
        $admin_id = session::get('id');
        $company_id = session::get('company_id');
        if($admin_id && $company_id){
            return redirect()->route('/');
        } else {
            return redirect()->route('login')->send();
        }
    }
    public function fileCreate()
    {
//        $this->Auth_login();
        $store_image = StoreImage::orderby('store_image_id','DESC')->where('company_id',Session::get('company_id'))->get();
        return view('storeimage.imageupload')->with('store_image',$store_image);
    }
    public function fileStore(Request $request,$services_id)
    {
//        $this->Auth_login();
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('CongtyTamViet/uploads'),$imageName);

        $imageUpload = new StoreImage();
        $imageUpload->store_image_file = $imageName;
        $imageUpload->services_id = $services_id;
        $imageUpload->company_id = Session::get('company_id');
        $imageUpload->user_id = Session::get('id');
        $imageUpload->save();

        return response()->json(['success'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
//        $this->Auth_login();
        $filename =  $request->get('filename');
        StoreImage::where('store_image_file',$filename)->where('company_id',Session::get('company_id'))->delete();
        $path='CongtyTamViet/uploads/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
    public function delete_file(Request $request, $store_image_id)
    {
//        $this->Auth_login();
        $store_image = StoreImage::where('store_image_id',$store_image_id)->where('company_id',Session::get('company_id'))->first();
        $filename =  $store_image->store_image_file;
        $path='CongtyTamViet/uploads/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        StoreImage::where('store_image_id',$store_image_id)->delete();
        return redirect()->back()->with('message','delete image successfully');
    }
    public function download_image($store_image_id)
    {
//        $this->Auth_login();
        $store_image = StoreImage::where('store_image_id',$store_image_id)->where('company_id',Session::get('company_id'))->first();
        $filename =  $store_image->store_image_file;
        $path='CongtyTamViet/uploads/'.$filename;
        return Response::download($path);
    }
}
