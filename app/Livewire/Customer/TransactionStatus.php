<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use Livewire\Component;

class TransactionStatus extends Component
{
    public $order;
    public function mount(){
         $data = ServiceTransaction::where('user_id', auth()->user()->id)->where('status', '!=', 'commpleted')->get();
        $this->order = $data->first();
        }

    public function render()
    {
        return view('livewire.customer.transaction-status');
    }
}
