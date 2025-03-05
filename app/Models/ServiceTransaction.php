<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTransaction extends Model
{
    protected $guarded = [];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderDetail(){
        return $this->hasOne(OrderDetail::class);
    }

    public function transactionOrderForms(){
        return $this->hasMany(TransactionOrderForm::class);
    }
}
