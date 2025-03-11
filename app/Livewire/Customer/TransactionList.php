<?php

namespace App\Livewire\Customer;

use App\Models\ServiceTransaction;
use App\Models\TransactionReport;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                    TextColumn::make('serviceType.name')->badge()->icon('heroicon-s-tag'),
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
                Action::make('report')->icon('heroicon-s-flag')->button()->size(ActionSize::Small)->badge()->color('danger')->visible(fn($record) => $record->status == 'Completed')->form([
                    Textarea::make('comment')->required(),
                   
                ])->modalHeading('Send Report')->action(
                    function($data, $record){
                        TransactionReport::create([
                            'service_transaction_id' => $record->id,
                            'comment' => $data['comment'],
                        ]);
                    }
                ),
                // Action::make('view_invoice')->icon('heroicon-s-ticket')->button()->size(ActionSize::Small)->badge(),
                
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
