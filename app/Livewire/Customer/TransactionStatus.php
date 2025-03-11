<?php

namespace App\Livewire\Customer;

use App\Models\ArrivalQueue;
use App\Models\ServiceTransaction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TransactionStatus extends Component implements HasForms
{
    use InteractsWithForms;
    public $order;
    public $queue;
    public $details;

    public $status;

    public $comment;
    public $payment = [];

    public $payment_modal = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               FileUpload::make('payment')->label('')
            ]);
    }

    public function pickUp(){
        $this->order->orderDetail->update([
            'order_type' => 'Pick Up',
        ]);
    }
    public function deliver(){
        $this->order->orderDetail->update([
            'order_type' => 'Deliver',
        ]);

        
    }

    public function mount(){
         $data = ServiceTransaction::where('user_id', auth()->user()->id)->where('status', '!=', 'Completed')->get();
        $this->order = $data->first();
        $this->status = $data;
        

        if ($this->status->count() > 0) {
            if ($this->order->is_on_the_way) {
                $userId = auth()->user()->id;
            
                $position = ArrivalQueue::where('id', '<', $userId)->count();
            
                // Add ordinal suffix (st, nd, rd, th)
                $this->queue = $position . $this->ordinalSuffix($position);
            }
    
            if ($this->order->status == 'placed order') {
                $this->details = $this->order->transactionOrderForms()
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
    
                $this->comment = $this->order->orderDetail->comment;
            }
        }else{
            
        }
        
    }

        public function sendComment(){
            $this->order->orderDetail->update([
                'comment' => $this->comment
               ]);
            $this->order->update([
                'status' => 'Completed',
            ]);

            return redirect()->route('customer.status');
        }

        public function uploadPayment(){
            foreach ($this->payment as $key => $value) {
               $this->order->orderDetail->update([
                'proof_of_payment' => $value->store('Payment', 'public'),
                'payment_rejected' => false
               ]);
            }
            $this->payment_modal = false;
        }

        private function ordinalSuffix($number)
{
    if (!in_array(($number % 100), [11, 12, 13])) {
        switch ($number % 10) {
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

    public function render()
    {
        return view('livewire.customer.transaction-status');
    }
}
