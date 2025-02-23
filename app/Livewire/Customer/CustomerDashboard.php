<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use Livewire\Component;

class CustomerDashboard extends Component
{
    public $option_modal = false;

    public $selected_laundry;
    public $selected_option;

    public function selectLaundry($laundry_id){
        $this->selected_laundry = $laundry_id;
        $this->option_modal = true;
    }

    public function selectOption($option){
        $this->selected_option = $option;

       $service = ServiceTransaction::create([
        'user_id' => auth()->user()->id,
        'shop_id' => $this->selected_laundry,
        'service_type_id' => $this->selected_option,
       ]);

        return redirect()->route('customer.transaction', ['id' => $service->id]);
        
    }

    public function render()
    {
        return view('livewire.customer.customer-dashboard');
    }
}
