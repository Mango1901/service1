<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//service

//user-login
route::get('/login','UserController@show_login')->name('login');
route::post('/login-save','UserController@login')->name('login.save');

Route::group(['middleware'=>'login'],function (){
    Route::get('/','ServiceController@index')->name('/');
    Route::get('/','ServiceController@home')->name('/');
    Route::get('/getItems','ServiceController@get_items')->name('get.item');
    Route::get('/items','ServiceController@show_items')->name('items');
    Route::get('/search','ServiceController@show_search')->name('search');
    Route::post('/search-list','ServiceController@searchItem')->name('search.list');
    Route::get('/service','ServiceController@add_service')->name('service');
    Route::post('/Add-service-save','ServiceController@add_service_save')->name('add.service.save');
    Route::get('/Add-service-update/{id}','ServiceController@add_service_update')->name('add.service.update');
    Route::post('/Add-service-update-save/{id}','ServiceController@add_service_update_save')->name('add.service.update.save');
    Route::get('/delete-service/{id}','ServiceController@delete_service')->name('delete.service');
    Route::get('/ajax-search-autocomplete', 'ServiceController@searchByName')->name('ajax.autocomplete.search');
//--xuất Excel
    Route::post('/export-excel','ServiceController@exportExcel')->name('export.excel');
    Route::get('/dowload', 'ServiceController@export')->name('export.excel.wr');
//--export PDF
    Route::get('export-pdf-service','ServiceController@exportService')->name('export.service');
//warranty
    route::get('/add-warranty-details/{services_id}','WarrantyController@warranty_show_details')->name('add.warranty.details');
    Route::post('/warranty-save-details/{services_id}','WarrantyController@warranty_save_details')->name('warranty.save.details');
    route::get('/warranty-details/{services_id}','WarrantyController@warranty_details')->name('warranty.details');
    route::get('/add-warranty-details-update/{services_id}/{id}','WarrantyController@warranty_show_details_update')->name('add.warranty.details.update');
    Route::post('/warranty-save-details-update/{services_id}/{id}','WarrantyController@warranty_save_details_update')->name('warranty.save.details.update');
//xuất pdf
    Route::get('export-pdf/{services_id}/{id}','WarrantyController@exportWarranty')->name('export.warranty');
    Route::get('export-pdf-ban2/{services_id}/{id}','WarrantyController@exportWarrantyVersion2')->name('export.warranty.version2');

//user
    route::get('/register','UserController@show_register')->name('register');
    route::post('/save-register','UserController@save_register')->name('save.register');
    route::get('/logout','UserController@logout')->name('logout');
    route::get('/delete-user/{id}','UserController@delete_user')->name('delete.user');
    route::get('/user','UserController@show_user')->name('user');
    route::get('/add-user-update/{id}','UserController@add_user_update')->name('add.user.update');
    route::post('/add-user-update-save/{id}','UserController@add_user_update_save')->name('add.user.update.save');
    route::get('/add-user-update-password/{id}','UserController@add_user_update_password')->name('add.user.update.password');
    route::post('/add-user-update-password-save/{id}','UserController@add_user_update_password_save')->name('add.user.update.password.save');
//customer
//route::get('/add-customer','CustomerController@show_add_customer')->name('add.customer');
    route::get('/add-customer','CustomerController@show_add_customer_popup')->name('add.customer');
    route::post('/add-customer-save','CustomerController@add_customer_save')->name('add.customer.save');
    route::get('/customer','CustomerController@show_customer')->name('customer');
    route::get('/update-customer/{customer_id}','CustomerController@update_customer')->name('update.customer');
    route::post('/update-customer-save/{customer_id}','CustomerController@update_customer_save')->name('update.customer.save');
    route::get('/delete-customer/{customer_id}','CustomerController@delete_customer')->name('delete.customer');
    route::post('/print-customer-address','CustomerController@print_customer_address')->name('print.customer.address');
//Category
    route::get('/add-category','CategoryController@show_add_category')->name('add.category');
    route::post('/category-save','CategoryController@category_save')->name('category.save');
    route::get('/category','CategoryController@show_category')->name('category');
    route::get('/update-category/{category_id}','CategoryController@update_category')->name('update.category');
    route::post('/update-category-save/{category_id}','CategoryController@update_category_save')->name('update.category.save');
    route::get('/delete-category/{category_id}','CategoryController@delete_category')->name('delete.category');
//product
    route::get('/add-product','ProductController@add_product')->name('add.product');
    route::post('/product-save','ProductController@product_save')->name('product.save');
    route::get('/product','ProductController@show_product')->name('product');
    route::get('/update-product/{product_id}','ProductController@update_product')->name('update.product');
    route::post('/update-product-save/{product_id}','ProductController@update_product_save')->name('update.product.save');
    route::get('/delete-product/{product_id}','ProductController@delete_product')->name('delete.product');
    route::post('/print-product-serial','ProductController@print_product_serial')->name('print.product.serial');
//Sent-Mail
    Route::get('/send-mail-update-services/{services_id}','SentMailController@send_mail_update_services');
    Route::get('/send-mail-update-warranty/{warranty_id}','SentMailController@send_mail_update_warranty');
//Image-upload
    Route::get('image/upload','StoreImageController@fileCreate')->name('image.upload');
    Route::post('image/upload/store/{services_id}','StoreImageController@fileStore')->name('image.upload.store');
    Route::post('image/delete','StoreImageController@fileDestroy');
    Route::get('image/delete-file/{store_image_id}','StoreImageController@delete_file')->name('image.delete_file');
    Route::get('image/download/{store_image_id}','StoreImageController@download_image')->name('image.download');
//company
    Route::get('register-company-admin','CompanyController@register_company_admin')->name('register.company.admin');
    Route::post('save-register-company-admin','CompanyController@save_register_company_admin')->name('save.register.company.admin');
    Route::get('company-admin','CompanyController@company_admin')->name('company.admin');
    Route::get('add-company-admin-update/{company_id}','CompanyController@company_admin')->name('add.company.admin.update');
    Route::post('add-company-admin-update-save/{company_id}','CompanyController@company_admin')->name('add.company.admin.update.save');
    Route::get('delete-company-admin/{company_id}','CompanyController@company_admin')->name('delete.company.admin');

});
