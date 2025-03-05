<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    public function serviceTransaction(){
        return $this->belongsTo(ServiceTransaction::class);
    }
}
