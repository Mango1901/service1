<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'company_name'
    ];
    protected $primaryKey = 'company_id';
    protected $table ='companies';
}
