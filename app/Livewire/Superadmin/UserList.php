<?php

namespace App\Livewire\Superadmin;

use App\Models\User;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserList extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('user_type', '!=', 'superadmin'))->headerActions([
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
                TextColumn::make('email')->label('EMAIL')->searchable(),
                TextColumn::make('user_type')->label('ROLE')->formatStateUsing(
                    fn($record) => ucfirst($record->user_type)
                )->searchable(),
                TextColumn::make('is_approved')->label('STATUS')->formatStateUsing(
                    fn($record) => $record->is_approved? 'Active' : 'Pending'
                )->searchable()->badge()->color(fn (string $state): string => match ($state) {
                    '0' => 'warning',
                    '1' => 'success',
                   
                }),
              
               
            ])
            ->filters([
                // ...
            ])
            ->actions([
               ActionGroup::make([
                Action::make('approve')->color('success')->icon('heroicon-m-hand-thumb-up')->action(
                    fn($record) => $record->update(['is_approved' => true]),
                )
               ])
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.superadmin.user-list');
    }
}
