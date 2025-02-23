<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    
    protected $guarded = [];

    public function serviceTransactions(){
        return $this->hasMany(ServiceTransaction::class);
    }
}
