<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use Livewire\Component;

class CustomerDashboard extends Component
{
    public $option_modal = false;

    public $selected_laundry;
    public $selected_option;

    public $laundry_name;

    public $pubmats = [];

    public $search;

    public function selectLaundry($laundry_id)
    {
        if (auth()->user()->locations->where('is_default', true)->count() > 0) {
            $this->selected_laundry = $laundry_id;
            $this->laundry_name = \App\Models\Shop::find($laundry_id)->name;
            $this->pubmats = \App\Models\ShopPubmat::where('shop_id', $laundry_id)->get();
            // $this->option_modal = true;
            $this->dispatch('open-modal', id: 'select-service-type');
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
        return view('livewire.customer.customer-dashboard', [
            'laundries' => \App\Models\Shop::where('is_active', true)
                ->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->get(),

        ]);
    }
}
