<?php

namespace App\Livewire\Admin;

use App\Models\ServiceTransaction;
use Carbon\Carbon;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Transaction extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    public function table(Table $table): Table
    {
        return $table
            ->query(ServiceTransaction::query()->where('status', 'Completed')->where('shop_id', auth()->user()->shop->id)->orderByDesc('created_at'))
            ->columns([
                
                Grid::make(1)
                    ->schema([
                            TextColumn::make('created_at')
                    ->formatStateUsing(fn($record) => 
                        'ORDER #' . $record->id .  '  |  ' . 
                        Carbon::parse($record->created_at)->format('h:i A') . ' - ' . 
                        Carbon::parse($record->created_at)->format('F d, Y')
                    ),
                    TextColumn::make('serviceType.name')->badge()->icon('heroicon-s-tag'),
                       
                    ])
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('view_report')->icon('heroicon-s-flag')->button()->size(ActionSize::Small)->badge()->color('warning')->form(
                    function($record) {
                        return [
                            Textarea::make('comment')->label('Report')->required()->live()->disabled()
                            ->afterStateHydrated(fn ($state, callable $set) => $set('comment', $state ?? $record->transactionReport->comment)),
                        ];
                    }
                )->modalWidth('xl')->modalSubmitActionLabel('Resolved Report')->modalHeading('Transaction Report')
                
            ])
            ->bulkActions([
                // ...
            ])->contentGrid([
                'md' => 3,
                'xl' => 4,
            ]);
    }
    public function render()
    {
        return view('livewire.admin.transaction');
    }
}
