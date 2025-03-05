<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogService extends Model
{
    protected $guarded = [];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public function transactionOrderForms(){
        return $this->hasMany(TransactionOrderForm::class);
    }
}
