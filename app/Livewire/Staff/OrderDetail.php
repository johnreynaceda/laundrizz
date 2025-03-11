<?php

namespace App\Livewire\Staff;

use App\Models\ServiceTransaction;
use Livewire\Component;

class OrderDetail extends Component
{
    public $transaction;
    public $detail;
    public $details;
    public function mount(){
        $id = ServiceTransaction::where('id', request('id'))->first();
        $this->detail = $id->orderDetail;

        $this->transaction = $id;
        
        $this->details = $id->transactionOrderForms()
        ->with(['catalog', 'catalogService']) // Eager load catalog and service
        ->get()
        ->groupBy('catalog_id') // Group by catalog_id
        ->map(function ($items) {
            return [
                'catalog' => $items->first()->catalog->name ?? '',
                'services' => $items->map(function ($item) {
                    return [
                        'service' => $item->catalogService->name ?? '',
                        'quantity' => $item->quantity,
                        'weight' => $item->weight,
                        'total' => $item->total,
                    ];
                }),
                'subtotal' => $items->sum('total'), // Subtotal per catalog
            ];
        })->values();

    }

    public function verifyPayment(){
        if ($this->detail->proof_of_payment != null) {
            $this->detail->update([
                'is_paid' => true,
            ]);
        }else{
            dd('no payment');
        }
    }
    public function orderProcessing(){
        if ($this->detail->is_paid) {
            $this->detail->update([
                'is_processing' => true,
            ]);
        }else{
            dd('not paid');
        }
    }
    public function markReady(){
        if ($this->detail->is_processing) {
            $this->detail->update([
                'is_ready' => true,
            ]);
        }else{
            dd('not processed');
        }
    }

    public function completed(){
        if ($this->detail->is_ready) {
            $this->detail->update([
                'is_complete' => true,
            ]);
            
        }else{
            dd('not processed');
      
        }
    }

    public function rejectPayment(){
        $this->detail->update([
            'proof_of_payment' => null,
            'payment_rejected' => true,
        ]);
    }
    public function render()
    {
        return view('livewire.staff.order-detail');
    }
}
