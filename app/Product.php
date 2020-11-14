<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'category_id','product_name','product_model','product_image','Action','product_notes','product_serial','company_id','user_id'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'products';
    public function Category(){
        return $this->hasOne('App\Category','category_id','category_id');
    }
    public function Service(){
    	return $this->hasMany('App\Service','product_id','product_id');
    }

}
