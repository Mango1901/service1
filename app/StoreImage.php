<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreImage extends Model
{
    public $timestamps = false;
    protected $fillable=[
      'store_image_file','company_id','user_id'
    ];
    protected $primaryKey = 'store_image_id';
    protected $table = 'store_images';
}
