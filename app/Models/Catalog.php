<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $guarded = [];

    public function catalogServices()
    {
        return $this->hasMany(CatalogService::class);
    }

    public function transactionOrderForms(){
        return $this->hasMany(TransactionOrderForm::class);
    }
}
