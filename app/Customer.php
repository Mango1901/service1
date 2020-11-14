<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable=[
      'customer_name','customer_email','customer_address','customer_phone','customer_contact','Action','company_id','user_id'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'customers';
    public function Service(){
    	return $this->hasMany('App\Service','customer_id','customer_id');
    }
}
