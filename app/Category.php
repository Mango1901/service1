<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'category_name','Action','company_id','user_id'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'categories';
    public function Product(){
    	return $this->hasMany('App\Product','category_id','category_id');
    }
}
