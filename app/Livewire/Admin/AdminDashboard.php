<?php

namespace App\Livewire\Admin;

use App\Models\OrderDetail;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard',[
            'sales' => OrderDetail::whereHas('serviceTransaction', function($record){
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed');
            })->where('is_complete', true)->get(),
            'today' => OrderDetail::whereHas('serviceTransaction', function($record){
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed');
            })->where('is_complete', true)->whereDate('created_at', now())->get(),
            'pickup' => OrderDetail::whereHas('serviceTransaction', function($record){
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed')->where('service_type_id', 1);
            })->where('is_complete', true)->whereDate('created_at', now())->count(),
            'dropoff' => OrderDetail::whereHas('serviceTransaction', function($record){
                $record->where('shop_id', auth()->user()->shop->id)->where('status', 'Completed')->where('service_type_id', 2);
            })->where('is_complete', true)->whereDate('created_at', now())->count(),
        ]);
    }
}
