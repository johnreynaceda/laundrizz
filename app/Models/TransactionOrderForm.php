<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionOrderForm extends Model
{
    protected $guarded = [];

    public function serviceTransaction(){
        return $this->belongsTo(ServiceTransaction::class);
    }

    public function catalog(){
        return $this->belongsTo(Catalog::class);
    }
    public function catalogService(){
        return $this->belongsTo(CatalogService::class);
    }
}
