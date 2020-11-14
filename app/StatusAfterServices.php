<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusAfterServices extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'status_services_name'
    ];
    protected $primaryKey = 'status_services_id' ;
    protected $table = 'status_after_services';
}
