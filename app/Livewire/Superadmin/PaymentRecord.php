<?php

namespace App\Livewire\Superadmin;

use App\Models\PaymentMethod;
use App\Models\SubscriptionPayment;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;

class PaymentRecord extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $gcash = [];

    public $upload_new = false;



    public function mount()
    {

    }

    public function table(Table $table): Table
    {
        return $table
            ->query(SubscriptionPayment::query())
            ->columns([
                TextColumn::make('shop.name')->searchable(),
                TextColumn::make('amount')->searchable(),
                TextColumn::make('is_paid')->label('Status')->searchable()->formatStateUsing(
                    fn($record) => ucfirst($record->is_paid ? 'Paid' : 'Not Paid')
                )->badge()->colors(
                        [
                            'Paid' => 'success',
                            'Not Paid' => 'warning',
                        ]
                    ),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('gcash')->label('Gcash QR Code'),
            ]);
    }

    public function uploadPhoto()
    {
        foreach ($this->gcash as $key => $value) {
            PaymentMethod::create([
                'user_id' => auth()->user()->id,
                'payment_photo' => encrypt($value->store('GCASH PAYMENT', 'public'))
            ]);
        }
        $this->reset('gcash');
    }
    public function uploadNew()
    {
        foreach ($this->gcash as $key => $value) {
            auth()->user()->paymentMethod->update([
                'payment_photo' => encrypt($value->store('GCASH PAYMENT', 'public'))
            ]);
        }
        $this->reset('gcash');
        $this->upload_new = false;
        return redirect()->route('superadmin.payments');
    }



    public function render()
    {
        return view('livewire.superadmin.payment-record');
    }
}
