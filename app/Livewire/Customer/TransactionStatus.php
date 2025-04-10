<?php

namespace App\Livewire\Customer;

use App\Models\ArrivalQueue;
use App\Models\ServiceTransaction;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use function Flasher\SweetAlert\Prime\sweetalert;

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

    public function pickUp()
    {
        $this->order->orderDetail->update([
            'order_type' => 'Pick Up',
        ]);
    }
    public function deliver()
    {
        $this->order->orderDetail->update([
            'order_type' => 'Deliver',
        ]);


    }

    public function mount()
    {
        $data = ServiceTransaction::where('user_id', auth()->user()->id)->where('status', '!=', 'Completed')->where('status', '!=', 'cancelled')->get();
        $this->order = $data->first();
        $this->status = $data;

        // if ($data->isNotEmpty()) {
        //     if (Carbon::parse($this->order->orderDetail->estimated_time)->isPast()) {
        //         if ($this->order->orderDetail->is_paid != true) {
        //             sweetalert()->error("This order is already due and no payment recorded");
        //             $this->order->update([
        //                 'status' => 'cancelled',
        //             ]);
        //         } else {

        //         }
        //     }
        // }


        if ($this->status->count() > 0) {
            if ($this->order->is_on_the_way) {
                $userId = auth()->user()->id;

                $queue = ArrivalQueue::where('shop_id', $this->order->shop_id)
                    ->orderBy('created_at')
                    ->get();


                $position = $queue->search(function ($item) use ($userId) {
                    return $item->user_id === $userId;
                });

                if ($position !== false) {
                    $position += 1;
                    $this->queue = $position . $this->ordinalSuffix($position);
                } else {
                    $this->queue = 'Not in queue';
                }
            }

            if ($this->order->status == 'placed order') {
                $this->details = $this->order->transactionOrderForms()
                    ->with(['catalog', 'catalogService'])
                    ->get()
                    ->groupBy('catalog_id')
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
                            'subtotal' => $items->sum('total'),
                        ];
                    })->values();

                $this->comment = $this->order->orderDetail->comment;
            }
        } else {

        }

    }

    public function sendComment()
    {
        $this->order->orderDetail->update([
            'comment' => $this->comment
        ]);
        $this->order->update([
            'status' => 'Completed',
        ]);

        sweetalert()->success('Comment Sucessfully sent to the merchant');

        return redirect()->route('customer.status');
    }

    public function uploadPayment()
    {
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
        if (!in_array($number % 100, [11, 12, 13])) {
            switch ($number % 10) {
                case 1:
                    return 'st';
                case 2:
                    return 'nd';
                case 3:
                    return 'rd';
            }
        }
        return 'th';
    }

    public function markAsExpired()
    {
        $this->order->update([
            'status' => 'cancelled',
        ]);
        sweetalert()->error('Your order has been expired without payment confirmation. This order will be known as cancelled.');
        return redirect()->route('customer.status');
    }

    public function cancelTransaction($id)
    {
        $data = ServiceTransaction::where('id', $id)->first();
        $data->update([
            'status' => 'cancelled',
        ]);
        return redirect()->route('customer.status');
    }

    public function render()
    {
        return view('livewire.customer.transaction-status');
    }
}
