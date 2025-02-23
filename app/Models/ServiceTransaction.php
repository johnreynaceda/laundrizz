<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model
{
    protected $guarded = [];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }
}
