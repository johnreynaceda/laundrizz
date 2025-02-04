<?php

namespace App\Livewire\Superadmin;

use App\Models\Subscription;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SubscriptionList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Subscription::query())->headerActions([
                CreateAction::make('new')->label('New Subscription')->icon('heroicon-o-plus-circle')->form([
                    Fieldset::make('PLAN INFORMATION')->schema([
                        TextInput::make('name')->required(),
                        Textarea::make('description')->columnSpan(2)->required(),
                        TextInput::make('amount')->numeric()->prefix('PHP')->required(),
                        TextInput::make('month')->label('No. of Months')->numeric()->required(),
                    ])
                ])->modalWidth('xl'),
            ])
            ->columns([
                TextColumn::make('name')->label('NAME')->searchable(),
                TextColumn::make('description')->label('DESCRIPTION')->searchable(),
                TextColumn::make('amount')->searchable()->label('AMOUNT')->formatStateUsing(
                    fn($record) => '₱'.number_format($record->amount,2)
                ),
                TextColumn::make('month')->searchable()->formatStateUsing(
                    fn($record) => $record->month.' month(s)'
                )->label('NO. OF MONTHS'),
                
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

    public function render()
    {
        return view('livewire.superadmin.subscription-list');
    }
}
