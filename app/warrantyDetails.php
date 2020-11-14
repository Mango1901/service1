<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class warrantyDetails extends Model
{
    public $timestamps = false;
    protected $fillable=[
        'warranty_date','warranty_hour','warranty_hour2', 'maintenance_engineer_id','replacement_components','user_id',
        'results','job_details','survey_results','services_id','warranty_status_error','warranty_cause','warranty_solution','warranty_notes','warranty_status','company_id'
    ];
    protected $primaryKey = 'warranty_id';
    protected $table = 'warranty_details';
    public function Service(){
    	return $this->hasOne('App\Service','services_id','services_id');
    }
}
