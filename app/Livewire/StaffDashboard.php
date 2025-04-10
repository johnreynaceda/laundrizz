<?php

namespace App\Livewire;

use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
use Livewire\Component;

class StaffDashboard extends Component
{
    public function render()
    {
        return view('livewire.staff-dashboard', [
            'pickups' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->staff->shop_id)->where('service_type_id', 1);
            })->get(),
            'dropoffs' => OrderDetail::whereHas('serviceTransaction', function ($record) {
                $record->where('shop_id', auth()->user()->staff->shop_id)->where('service_type_id', 2);
            })->get(),
        ]);
    }
}
