<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusService extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'Status_name'
    ];
    protected $primaryKey ='Status_id';
    protected $table = 'status_services';
    public function Service()
    {
    	return $this->hasMany('App\Service','Status','Status_id');
    }
}
