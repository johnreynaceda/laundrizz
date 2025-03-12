<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use Livewire\Component;

class CustomerDashboard extends Component
{
    public $option_modal = false;

    public $selected_laundry;
    public $selected_option;

    public function selectLaundry($laundry_id)
    {
        if (auth()->user()->locations->where('is_default', true)->count() > 0) {
            $this->selected_laundry = $laundry_id;
            $this->option_modal = true;
        } else {
            sweetalert()->error('Please setup your location first. Make sure to set a default location.');
        }


    }

    public function selectOption($option)
    {
        $data = ServiceTransaction::where('user_id', auth()->user()->id)->where('status', '!=', 'Completed')->where('status', '!=', 'cancelled')->get();
        if ($data->count() > 0) {
            sweetalert()->info("You have an ongoing transaction.\nPlease complete your transaction before making a new one.");
        } else {
            $this->selected_option = $option;

            $service = ServiceTransaction::create([
                'user_id' => auth()->user()->id,
                'shop_id' => $this->selected_laundry,
                'service_type_id' => $this->selected_option,
            ]);

            return redirect()->route('customer.transaction', ['id' => $service->id]);
        }



    }

    public function render()
    {
        return view('livewire.customer.customer-dashboard');
    }
}
