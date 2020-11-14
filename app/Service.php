<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;
    protected $fillable=[
      'Serial' ,'product_id' ,'Status','start_date','end_date','customer_id','Address','installation_engineer_id','Action','company_id','user_id'
    ];
    protected $primaryKey = 'services_id';
    protected $table= 'services';
    public function Warranty_Details(){
    	return $this->hasMany('App\Warranty_Details','services_id','services_id');
    }
     public function Product(){
    	return $this->hasOne('App\Product','product_id','product_id');
    }
     public function Customer(){
    	return $this->hasOne('App\Customer','customer_id','customer_id');
    }
    public function StatusService()
    {
    	return $this->hasOne('App\StatusService','Status_id','Status');
    }
    public function User(){
    	return $this->belongsTo('App\User','installation_engineer_id','id');
    }
}
