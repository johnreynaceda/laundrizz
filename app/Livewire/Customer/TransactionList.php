<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use Carbon\Carbon;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class TransactionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(ServiceTransaction::query()->where('user_id', auth()->user()->id)->orderByDesc('created_at'))
            ->columns([
                Split::make([
                    TextColumn::make('created_at')
                    ->formatStateUsing(fn($record) => 
                        'ORDER #' . $record->id .  '  |  ' . 
                        Carbon::parse($record->created_at)->format('h:i A') . ' - ' . 
                        Carbon::parse($record->created_at)->format('F d, Y')
                    )
                    ->html(),
                    TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'Completed' => 'success',
                        'placed order' => 'info',
                        'accepted' => 'success',
                    }),
                   ])->from('md')
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('view')->icon('heroicon-o-eye')->button()->size(ActionSize::Small),
                // Action::make('view_invoice')->icon('heroicon-o-file-invoice')->url(fn($record) => route('customer.transaction.invoice', $record->id)),
                // Action::make('cancel_order')->icon('heroicon-o-x')->confirm('Are you sure you want to cancel this order?')
                //     ->action(function (ServiceTransaction $record) {
                //         $record->is_cancelled = true;
                //         $record->save();
                //     }),
            ])
            ->bulkActions([
                // ...
            ]);
    }
    
    public function render()
    {
        return view('livewire.customer.transaction-list');
    }
}
